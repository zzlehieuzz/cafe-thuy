<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class DishController extends BaseAdminController {

    /**
     * @param $page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function listDish($page)
    {
        $category = Category::whereNull('parent_id')->get()->lists('name', 'id');

        $dish = Dish::with('dishCategories')->with('dishImages')
            ->select('dish.id', 'dish.title', 'dish.price', 'dish.view_num', 'di.image_name')
            ->leftjoin('dish_category AS dc', 'dc.dish_id', '=', 'dish.id')
            ->leftjoin('dish_image AS di', 'di.dish_id', '=', 'dish.id')
            ->groupBy('dish.id')
            ->orderBy('dish.id', 'DESC');

        $inputTitle = '';
        if (Request::isMethod('get')) {
            $inputTitle = Input::get('title');
            if($inputTitle) {
                $dish->where('dish.title', 'LIKE', $inputTitle . '%');
            }
        }

        $dish = Dish::pager($dish, $page);
        $data = array();
        if ($dish['data']) {
            $arrData = $dish['data']->toArray();
            foreach($arrData as $key => $dataItem) {
                $listCategory = array();
                $countImage   = count($dataItem['dish_images']);
                $imageUrl = '';
                if(isset($dataItem['dish_images'][0]['image_name'])) {
                    $imageUrl = asset(Config::get('app.view')) . '/' . Dish::createPathThump($dataItem['dish_images'][0]['image_name']);
                }

                $dataItem['count_image'] = $countImage;
                $dataItem['image_url']   = $imageUrl;
                unset($dataItem['dish_images']);

                foreach($dataItem['dish_categories'] as $categoryItem) {
                    if(isset($category[$categoryItem['category_id']])) {
                        $listCategory[] = $category[$categoryItem['category_id']];
                    }
                }

                unset($dataItem['dish_categories']);
                $dataItem['list_category'] = $listCategory;

                $data[] = $dataItem;
            }
        }

        $totalPage  = $dish['totalPage'];
        $totalItems = $dish['totalItems'];

        if($page < 1) {
            return Redirect::to('dish/listDish/' . 1);
        }

        if($page > $totalPage) {
            return Redirect::to('dish/listDish/' . $totalPage . '?' . implode(array('title=' . $inputTitle)));
        }

        return $this->layout->main = View::make('admin.dish.list-dish',
            array('dish'       => $data,
                  'input'      => array('title' => $inputTitle),
                  'page'       => $page,
                  'totalPage'  => $totalPage,
                  'totalItems' => $totalItems));
    }

    /**
     *
     */
    public function createDish()
    {
        if (Request::isMethod('post')) {
            $params  = Input::all();
            $vParams = Dish::validate($params);

            $detailErrors = Dish::getValidationMessages();
            if ($vParams) {
                $fileNames = array();

                if(isset($params['imageFiles'][0]) && ($imageFiles = $params['imageFiles'])) {
                    $isFalseImage = false;
                    foreach ($imageFiles as $file) {
                        if (!file_exists($file)) {
                            $isFalseImage = true;
                            break;
                        }
                        $vImage = DishImage::validate(array('imageFiles' => $file));
                        if(!$vImage) {
                            $isFalseImage = true;
                            break;
                        }
                    }

                    if(!$isFalseImage) {
                        foreach($imageFiles as $file) {
                            $originalExt   = $file->getClientOriginalExtension();
                            $photoFileName = ApiUtil::createImageName($originalExt);
                            $fileNames[]   = $photoFileName;
                            $this->uploadDishImage($file, $photoFileName);
                        }
                    }
                }

                if(isset($isFalseImage) && !$isFalseImage) {
                    $detail = new Dish();
                    $result = $this->processDish($detail, $params, $fileNames);
                    if ($result) {
                        return Redirect::to('dish/createDish')->withSuccess('Your dish was added with success.')->withInput();
                    }
                } else {
                    if($detailErrors) {
                        $detailErrors+=DishImage::getValidationMessages();
                    } else {
                        $detailErrors = DishImage::getValidationMessages();
                    }
                }
            }

            return Redirect::to('dish/createDish')->withErrors($detailErrors)->withInput();
        }

        return $this->layout->main = View::make('admin.dish.create-dish');
    }

    /**
     * @param $dishId
     * @return \Illuminate\View\View
     */
    public function editDish($dishId)
    {
        $dish = Dish::where('id', $dishId)->first();

        if ($dish) {
            $listDishCategory = DishCategory::select('dish_category.category_id', 'c.name AS category_name')
                ->leftjoin('category AS c', 'c.id', '=', 'dish_category.category_id')
                ->where('dish_id', $dishId)->get();

            if ($listDishCategory) {
                $listDishCategory = $listDishCategory->toArray();
            }

            $listDishImage = DishImage::where('dish_id', $dishId)->get();
            $arrImage      = array();
            if ($listDishImage) {
                $listDishImage = $listDishImage->toArray();
                foreach($listDishImage as $key => $dishImageItem) {
                    $arrImage[$key]['image_url'] = asset(Config::get('app.view')) . '/' . Dish::createPathThump($dishImageItem['image_name']);
                    $arrImage[$key]['id']        = $dishImageItem['id'];
                }
            }

            if (Request::isMethod('post')) {
                $params  = Input::all();
                $vParams = Dish::validate($params);
                $detailErrors = Dish::getValidationMessages();
                if ($vParams) {
                    $fileNames = array();

                    if(isset($params['imageFiles'][0]) && ($imageFiles = $params['imageFiles'])) {
                        $isFalseImage = false;
                        foreach ($imageFiles as $file) {
                            if (!file_exists($file)) {
                                $isFalseImage = true;
                                break;
                            }
                            $vImage = DishImage::validate(array('imageFiles' => $file));
                            if(!$vImage) {
                                $isFalseImage = true;
                                break;
                            }
                        }

                        if(!$isFalseImage) {
                            foreach($imageFiles as $file) {
                                $originalExt   = $file->getClientOriginalExtension();
                                $photoFileName = ApiUtil::createImageName($originalExt);
                                $fileNames[]   = $photoFileName;
                                $this->uploadDishImage($file, $photoFileName);
                            }
                        }
                    }

                    if (isset($params['removeImages']) && ($removeImages = $params['removeImages'])) {
                        $listIdImage = explode(',', $removeImages);
                        $dishImage = DishImage::whereIn('id', $listIdImage);

                        $this->removeDishImage($dishImage);
                    }
                    $imageErrors = DishImage::getValidationMessages();

                    if(!$imageErrors && !$detailErrors) {
                        $result = $this->processDish($dish, $params, $fileNames);
                        if ($result) {
                            return Redirect::to('dish/editDish/' . $dishId)->withSuccess('Your dish was updated with success.')->withInput();
                        }
                    } else {
                        if($detailErrors) {
                            $detailErrors+=$imageErrors;
                        } else {
                            $detailErrors = $imageErrors;
                        }
                    }
                }
                if($detailErrors) {
                    return Redirect::to('dish/editDish/' . $dishId)->withErrors($detailErrors)->withInput();
                }

                return Redirect::to('dish/editDish/' . $dishId)->withSuccess('Your dish was updated with success.');
            }

            return $this->layout->main = View::make('admin.dish.edit-dish')
                ->with('dish', $dish)
                ->with('listImageCategory', $arrImage)
                ->with('listDishCategory', $listDishCategory);
        }

        return Redirect::to('dish/listDish')->withSuccess('Your photo was not found.');
    }

    /**
     * @param $dishId
     *
     * @return Redirect
     */
    public function deleteDish($dishId)
    {
        $dish = Dish::where('dish.id', $dishId)->first();
        $dishRoute = 'dish/listDish';
        if ($dish) {
            $dishCategory = DishCategory::where('dish_category.dish_id', $dishId);
            $dishImage    = DishImage::where('dish_image.dish_id', $dishId);

            if($dishCategory) {
                $dishCategory->delete();
            }

            if($dishImage) {
                $arrDishImage = $dishImage->get()->toArray();
                foreach($arrDishImage as $dishImageItem) {
                    $this->removeDish($dishImageItem['image_name']);
                }
                $dishImage->delete();
            }

            if($dish->delete()) {
                return Redirect::to($dishRoute)->withSuccess('Your photo was deleted with success.');
            }
        }

        return Redirect::to($dishRoute);
    }

    public function popupAddCategory()
    {
        $category = Category::select('id', 'name')
            ->whereNull('parent_id')->orderBy('name', 'ASC')->get()->toArray();

        return $this->layout->main = View::make('admin.popup.add-category')
            ->with('category', $category);
    }

    /**
     * @param Dish $dish
     * @param $params
     * @param $fileNames
     *
     * @return bool
     */
    private function processDish(Dish $dish, $params, $fileNames) {
        $arrData = array(
            'title'       => ApiUtil::getKeyParam($params, 'title'),
            'price'       => ApiUtil::getKeyParam($params, 'price'),
            'description' => ApiUtil::getKeyParam($params, 'description')
        );

        if ($id = $dish->id) {
            $dish->title       = $arrData['title'];
            $dish->description = $arrData['description'];
            $dish->price       = $arrData['price'];
            $dish->update();
        } else $id = Dish::insertGetId($arrData);

        if ($id) {
            if($fileNames) {
                foreach ($fileNames as $fileName) {
                    $arrFileName['dish_id']    = $id;
                    $arrFileName['image_name'] = $fileName;
                    DishImage::insert($arrFileName);
                }
            }

            if(isset($params['category_list']) && ($categoryList = $params['category_list'])) {
                $photoCategory = DishCategory::where('dish_id', $dish->id);
                if ($photoCategory) {
                    $photoCategory->delete();
                }

                $arrCategory = array('dish_id' => $id);

                foreach ($categoryList as $categoryItem) {
                    $arrCategory['category_id'] = $categoryItem;
                    DishCategory::insert($arrCategory);
                }
            }
        }

        return true;
    }

    /**
     * @param $file
     * @param $fileName
     */
    private function uploadDishImage($file, $fileName) {
        $normalSize = ApiUtil::scaleHeight($file, Dish::HEIGHT_NORMAL_IMAGE);
        $thumpSize  = ApiUtil::scaleHeight($file, Dish::HEIGHT_THUMPS_IMAGE);

        File::makeDirectory(public_path(Dish::getPathOriginal()), 0777, true, true);
        File::makeDirectory(public_path(Dish::getPathNormal()), 0777, true, true);
        File::makeDirectory(public_path(Dish::getPathThump()), 0777, true, true);

        $normal = SomeUniqueName::make($file)
            ->resize($normalSize['width'], $normalSize['height']);
        $normal->save(Config::get('app.view') . Dish::createPathNormal($fileName));

        $thump = SomeUniqueName::make($file)
            ->resize($thumpSize['width'], $thumpSize['height']);
        $thump->save(Config::get('app.view') . Dish::createPathThump($fileName));

        $original = SomeUniqueName::make($file);
        $original->save(Config::get('app.view') . Dish::createPathOriginal($fileName));
    }

    /**
     * @param $dishImage
     */
    private function removeDishImage($dishImage) {
        if ($dishImage) {
            $listImages = $dishImage->get()->toArray();
            $arrFile    = array();
            foreach ($listImages as $imageItem) {
                $fileName  = $imageItem['image_name'];
                $arrFile[] = Dish::createPathThump($fileName);
                $arrFile[] = Dish::createPathNormal($fileName);
                $arrFile[] = Dish::createPathOriginal($fileName);
            }
            if($arrFile) {
                File::delete($arrFile);
            }

            $dishImage->delete();
        }
    }

    /**
     * @description delete image in folder [original, large, normal, thump]
     *
     * @param $imageName
     */
    private function removeDish($imageName) {
        $arrFile = array(
            Config::get('app.view') . Dish::createPathThump($imageName),
            Config::get('app.view') . Dish::createPathNormal($imageName),
            Config::get('app.view') . Dish::createPathOriginal($imageName)
        );

        File::delete($arrFile);
    }
}
