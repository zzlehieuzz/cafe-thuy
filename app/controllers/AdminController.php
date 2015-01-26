<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class AdminController extends BaseController {

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'admin';

    public function __construct(){
        $this->beforeFilter(function(){
            if (!Auth::check()) {
                return Redirect::to('login/index')
                    ->withErrors('You need to be logged in.');
            }
        });

        $this->beforeFilter('csrf' , array('on'=>'post')) ;
    }

    /**
     *
     */
    public function detail($page)
    {
        $detail = Detail::with('detailImages')
            ->select('id', 'title', 'address', 'phone', 'thump_image')
            ->orderBy('id', 'DESC');
        $inputTitle = '';
        if (Request::isMethod('get')) {
            $inputTitle = Input::get('title');
            if($inputTitle) {
                $detail->where('title', 'LIKE', $inputTitle . '%');
            }
        }

        $detail = Detail::pager($detail, $page);
        $data = array();
        if ($detail['data']) {
            $data = $detail['data']->toArray();
        }

        $totalPage  = $detail['totalPage'];
        $totalItems = $detail['totalItems'];

        if($page < 1) {
            return Redirect::to('admin/detail/' . 1);
        }

        if($page > $totalPage) {
            return Redirect::to('admin/detail/' . $totalPage . '?' . implode(array('title=' . $inputTitle)));
        }

        return $this->layout->main = View::make('admin.list-detail',
            array('detail'     => $data,
                  'input'      => array('title' => $inputTitle),
                  'page'       => $page,
                  'totalPage'  => $totalPage,
                  'totalItems' => $totalItems));
    }

    public function deleteDetail($detailId)
    {
        $detail = Detail::where('detail.id', $detailId);
        if ($detail) {
            $shopCategory = ShopCategory::where('shop_category.detail_id', $detailId);
            if($shopCategory) {
                $shopCategory->delete();
            }
            $shopRoad = ShopRoad::where('shop_road.detail_id', $detailId);
            if($shopRoad) {
                $shopRoad->delete();
            }

            $detailImages = DetailImage::where('detail_image.detail_id', $detailId);
            if($detailImages) {
                $this->remove($detailImages);
            }

            if($detail->delete()) {
                return Redirect::to('admin/detail')->withSuccess('Your detail was deleted with success.');
            }
        }

        return Redirect::to('admin/detail');
    }

    /**
     *
     */
    public function createDetail()
    {
        if (Request::isMethod('post')) {
            $params  = Input::all();
            $vParams = Detail::validate($params);

            if ($vParams) {
                $falseImage   = false;
                $isFalseImage = false;
                $arrFileName  = array();

                if(isset($params['detailImages']) && ($fileDetailImages = $params['detailImages'])) {
                    if(is_array($fileDetailImages)) {
                        foreach ($fileDetailImages as $file) {
                            if (!file_exists($file)) {
                                $isFalseImage = true;
                                break;
                            }
                            $vImage = DetailImage::validate(array('file' => $file));
                            if(!$vImage) {
                                $falseImage = true;
                                break;
                            }
                        }

                        if (!$falseImage && !$isFalseImage) {
                            foreach ($fileDetailImages as $file) {
                                $originalExt   = $file->getClientOriginalExtension();
                                $fileName      = ApiUtil::createImageName($originalExt);
                                $arrFileName[] = $fileName;

                                $this->upload($file, $fileName);
                            }
                        }
                    }
                }

                if(isset($params['thumpImage']) && ($thumpImage = $params['thumpImage'])) {
                    $falseThumpImage = $isFalseThumpImage = false;
                    if (!file_exists($thumpImage)) {
                        $isFalseThumpImage = true;
                    }
                    $vThumpImage = DetailImage::validate(array('file' => $thumpImage));
                    if(!$vThumpImage) {
                        $falseThumpImage = true;
                    }

                    if (!$falseThumpImage && !$isFalseThumpImage) {
                        $originalExt   = $thumpImage->getClientOriginalExtension();
                        $fileName      = ApiUtil::createImageName($originalExt);

                        $this->uploadThump($thumpImage, $fileName);
                        $params['thump_image'] = $fileName;
                    }
                }

                if (!$falseImage) {
                    $detail = new Detail();
                    $result = $this->processDetail($detail, $params, $arrFileName);

                    if ($result) {
                        return Redirect::to('admin/createDetail')->withSuccess('Your detail was added with success.');
                    }
                }
            }

            $detailErrors      = Detail::getValidationMessages();
            $detailImageErrors = DetailImage::getValidationMessages();

            if ($detailErrors && $detailImageErrors) {
                $errors = $detailErrors + $detailImageErrors;
            }

            elseif ($detailErrors && !$detailImageErrors) {
                $errors = $detailErrors;
            }
            elseif ($detailImageErrors && !$detailErrors) {
                $errors = $detailImageErrors;
            } else {
                $errors = array();
            }

            if ($errors) {
                return Redirect::to('admin/createDetail')->withErrors($errors)->withInput();
            }

            return Redirect::to('admin/createDetail');
        }

        return $this->layout->main = View::make('admin.create-detail');
    }

    /**
     * @param $detailId
     * @return mixed
     */
    public function editDetail($detailId)
    {
        $detail = Detail::where('id', $detailId)->first();

        if ($detail) {
            $listDetailImage = DetailImage::select('id', 'name')
                ->where('detail_id', $detailId)->isActive()->get();

            $listShopCategory = ShopCategory::select('shop_category.root_category_id', 'c1.name AS root_category_name'
                                                   , 'shop_category.category_id', 'c2.name AS category_name')
                ->leftjoin('category AS c1', 'c1.id', '=', 'shop_category.root_category_id')
                ->leftjoin('category AS c2', 'c2.id', '=', 'shop_category.category_id')
                ->where('detail_id', $detailId)->get();

            $listShopRoad = ShopRoad::select('shop_road.root_road_id', 'c1.name AS root_road_name'
                                           , 'shop_road.road_id', 'c2.name AS road_name')
                ->leftjoin('road AS c1', 'c1.id', '=', 'shop_road.root_road_id')
                ->leftjoin('road AS c2', 'c2.id', '=', 'shop_road.road_id')
                ->where('detail_id', $detailId)->get();

            if ($listShopCategory) {
                $listShopCategory = $listShopCategory->toArray();
            }

            if ($listShopRoad) {
                $listShopRoad = $listShopRoad->toArray();
            }

            $detailImage = array();
            if ($listDetailImage) {
                $detailImage = $listDetailImage->toArray();
            }

            if (Request::isMethod('post')) {
                $params = Input::all();
                $vParams = Detail::validate($params);

                if ($vParams) {
                    $arrFileName = array();
                    $falseImage    = false;
                    $isFalseImage  = false;
                    if (isset($params['detailImages']) && ($fileDetailImages = $params['detailImages'])) {
                        if (is_array($fileDetailImages)) {
                            foreach ($fileDetailImages as $file) {
                                if (!file_exists($file)) {
                                    $isFalseImage = true;
                                    break;
                                }
                                $vImage = DetailImage::validate(array('file' => $file));

                                if (!$vImage) {
                                    $falseImage = true;
                                    break;
                                }
                            }

                            if (!$falseImage & !$isFalseImage) {
                                foreach ($fileDetailImages as $file) {
                                    $originalExt = $file->getClientOriginalExtension();
                                    $fileName    = ApiUtil::createImageName($originalExt);
                                    $arrFileName[] = $fileName;

                                    $this->upload($file, $fileName);
                                }
                            }
                        }
                    }

                    if (isset($params['removeDetailImages']) && ($removeDetailImages = $params['removeDetailImages'])) {
                        $listIdImage = explode(',', $removeDetailImages);
                        $detailImages = DetailImage::whereIn('id', $listIdImage);
                        $this->remove($detailImages);
                    }

                    if(isset($params['thumpImage']) && ($thumpImage = $params['thumpImage'])) {
                        $vThumpImage = DetailImage::validate(array('file' => $thumpImage));
                        $detailImageErrors = DetailImage::getValidationMessages();

                        if ($vThumpImage) {
                            $originalExt   = $thumpImage->getClientOriginalExtension();
                            $fileName      = ApiUtil::createImageName($originalExt);

                            $this->uploadThump($thumpImage, $fileName);
                            $params['thump_image'] = $fileName;

                            $this->removeThump($thumpImage);
                        }
                    }

                    if (!$falseImage) {
                        $result = $this->processDetail($detail, $params, $arrFileName);

                        if ($result) {
                            return Redirect::to('admin/editDetail/' . $detailId)
                                ->withSuccess('Your detail was updated with success.');
                        }
                    }
                }

                $detailErrors = Detail::getValidationMessages();
                $detailImageErrors = DetailImage::getValidationMessages();

                if ($detailErrors && $detailImageErrors) {
                    $errors = $detailErrors + $detailImageErrors;
                } elseif ($detailErrors && !$detailImageErrors) {
                    $errors = $detailErrors;
                } elseif ($detailImageErrors && !$detailErrors) {
                    $errors = $detailImageErrors;
                } else {
                    $errors = array();
                }

                if ($errors) {
                    return Redirect::to('admin/editDetail/' . $detailId)->withErrors($errors)->withInput();
                }

                return Redirect::to('admin/editDetail/' . $detailId);
            }

            return $this->layout->main = View::make('admin.edit-detail')
                ->with('detail', $detail)
                ->with('listShopCategory', $listShopCategory)
                ->with('listShopRoad', $listShopRoad)
                ->with('detailImage', $detailImage);
        }

        return Redirect::to('admin/detail')->withSuccess('Your detail was not found.');
    }

    /**
     * @param Detail $detail
     * @param $params
     * @param $arrFileName
     * @return bool
     */
    private function processDetail(Detail $detail, $params, $arrFileName = array()) {
        $detail->title   = $params['title'];
        $detail->content = $params['content'];
        $detail->address = $params['address'];
        $detail->phone   = $params['phone'];
        if(isset($params['thump_image'])) {
            $detail->thump_image = $params['thump_image'];
        }
        $detail->push();
        if ($arrFileName) {
            foreach ($arrFileName as $fileName) {
                $detailImage = new DetailImage();
                $detailImage->name = $fileName;
                $detailImage->detail_id = $detail->id;
                $detailImage->push();
            }
        }

        if (isset($params['root_category_list'])
            && ($rootCategoryList = $params['root_category_list'])
            && isset($params['category_list'])
            && ($categoryList = $params['category_list'])) {

            $shopCategory = ShopCategory::where('detail_id', $detail->id);
            if ($shopCategory) {
                $shopCategory->delete();
            }

            foreach ($rootCategoryList as $key => $rootCategoryItem) {
                $shopCategory = new ShopCategory();
                $shopCategory->detail_id        = $detail->id;
                $shopCategory->root_category_id = $rootCategoryItem;
                $shopCategory->category_id      = $categoryList[$key];

                $shopCategory->push();
            }
        }

        if (isset($params['root_road_list'])
            && ($rootRoadList = $params['root_road_list'])
            && isset($params['road_list'])
            && ($roadList = $params['road_list'])) {

            $shopRoad = ShopRoad::where('detail_id', $detail->id);
            if ($shopRoad) {
                $shopRoad->delete();
            }

            foreach ($rootRoadList as $key => $rootRoadItem) {
                $shopRoad = new ShopRoad();
                $shopRoad->detail_id    = $detail->id;
                $shopRoad->root_road_id = $rootRoadItem;
                $shopRoad->road_id      = $roadList[$key];

                $shopRoad->push();
            }
        }

        $detail->save();

        return true;
    }

    /**
     * @param $file
     * @param $fileName
     */
    private function upload($file, $fileName) {
//        $normalSize = DetailImage::scaleSize($file, DetailImage::WIDTH_NORMAL_IMAGE, DetailImage::HEIGHT_NORMAL_IMAGE);
//        $largeSize  = DetailImage::scaleSize($file, DetailImage::WIDTH_LARGE_IMAGE, DetailImage::HEIGHT_LARGE_IMAGE);
//        $thumpSize  = DetailImage::scaleSize($file, DetailImage::WIDTH_THUMPS_IMAGE, DetailImage::HEIGHT_THUMPS_IMAGE);

        $folder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathDetailImage(), 0777, true, true);
        $largeFolder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathLargeDetailImage(), 0777, true, true);
        $large = SomeUniqueName::make($file);
        $large->save(DetailImage::createPathLargeDetailImage($fileName));

//        $normalFolder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathNormalDetailImage(), 0777, true, true);
//        $normal = SomeUniqueName::make($file);
//        $normal->save(DetailImage::createPathNormalDetailImage($fileName));

//        $thumpsFolder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathThumpsDetailImage(), 0777, true, true);
//        $thumps = SomeUniqueName::make($file)
//            ->resize($thumpSize['width'], $thumpSize['height']);
//        $thumps->save(DetailImage::createPathThumpsDetailImage($fileName));

//        $file->move(DetailImage::getPathDetailImage(), $fileName);
    }

    private function uploadThump($file, $fileName) {
        $folder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathDetailImage(), 0777, true, true);

        $normalFolder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathNormalDetailImage(), 0777, true, true);
        $normal = SomeUniqueName::make($file);
        $normal->save(DetailImage::createPathNormalDetailImage($fileName));

        $thumpSize  = DetailImage::scaleSize($file, DetailImage::WIDTH_THUMPS_IMAGE, DetailImage::HEIGHT_THUMPS_IMAGE);

        $thumpsFolder = File::makeDirectory(public_path(Config::get('app.view')). '/' . DetailImage::getPathThumpsDetailImage(), 0777, true, true);
        $thumps = SomeUniqueName::make($file)
            ->resize($thumpSize['width'], $thumpSize['height']);
        $thumps->save(DetailImage::createPathThumpsDetailImage($fileName));
    }

    /**
     * @param $detailImages
     */
    private function remove($detailImages) {
        $listDetailImages = $detailImages->select('name')->get();
        if ($listDetailImages) {
            $listDetailImages = $listDetailImages->toArray();
            foreach ($listDetailImages as $detailImageItem) {
                $arrFile   = array();
                $fileName  = $detailImageItem['name'];
                $arrFile[] = DetailImage::createPathLargeDetailImage($fileName);

                File::delete($arrFile);
            }
            $detailImages->delete();
        }
    }

    /**
     * @param $thumpImageName
     */
    private function removeThump($thumpImageName) {
        $arrFile[] = DetailImage::createPathNormalDetailImage($thumpImageName);
        $arrFile[] = DetailImage::createPathThumpsDetailImage($thumpImageName);

        File::delete($arrFile);
    }

    private function loadCategory($parentId) {
        return Category::select('id', 'parent_id', 'name')
            ->where('parent_id', $parentId)
            ->whereNotNull('parent_id')->get();
    }

    private function loadRoad($parentId) {
        return Road::select('id', 'parent_id','name')
            ->where('parent_id', $parentId)
            ->whereNotNull('parent_id')
            ->orderBy('name', 'ASC')->get();
    }

    /**
     */
    public function loadCategoryById() {
        $id     = Input::get('id');
        $result = array();
        if ($id) {
            $res = $this->loadCategory($id);
            if ($res) {
                $result = $res->toArray();
            }
        }

        return $this->jsonResponse($result);
    }

    /**
     */
    public function loadRoadById() {
        $id     = Input::get('id');
        $result = array();
        if ($id) {
            $res = $this->loadRoad($id);
            if ($res) {
                $result = $res->toArray();
            }
        }

        return $this->jsonResponse($result);
    }

    public function popupAddCategory()
    {
        $optionRootCategory = Category::select('id', 'name')
            ->whereNull('parent_id')->orderBy('name', 'ASC')->lists('name','id');

        if(empty($categoryParentId) && ($optionRootCategory)) {
            $categoryParentId = key($optionRootCategory);
        }

        $category = $this->loadCategory($categoryParentId);
        $arrCategory = array();
        if($category) {
            $arrCategory = $category->toArray();
        }

        return $this->layout->main = View::make('admin.popup.add-category')
            ->with('optionCategory', $arrCategory)
            ->with('optionRootCategory', $optionRootCategory);
    }

    public function popupAddRoad()
    {
        $optionRootRoad = Road::select('id', 'name')
            ->whereNull('parent_id')->orderBy('name', 'ASC')->lists('name','id');

        if(empty($roadParentId) && ($optionRootRoad)) {
            $roadParentId = key($optionRootRoad);
        }

        $road = $this->loadRoad($roadParentId);
        $arrRoad = array();
        if($road) {
            $arrRoad = $road->toArray();
        }

        return $this->layout->main = View::make('admin.popup.add-road')
            ->with('optionRoad', $arrRoad)
            ->with('optionRootRoad', $optionRootRoad);
    }
}
