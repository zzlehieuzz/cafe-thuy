<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class DishController extends BaseAdminController {

    /**
     *
     */
    public function listDish($page)
    {
        $inputTitle = '';
        $data = array();
        if (Request::isMethod('get')) {
            $inputTitle = Input::get('title');
            if($inputTitle) {
//                $photo->where('title', 'LIKE', $inputTitle . '%');
            }
        }

        return $this->layout->main = View::make('admin.dish.list-dish',
            array(
                'photo'      => $data,
                'input'      => array('title' => $inputTitle),
                'page'       => $page,
//                'totalPage'  => $totalPage,
//                'totalItems' => $totalItems
            ));
    }

    /**
     *
     */
    public function createDish()
    {
        if (Request::isMethod('post')) {
            echo '<pre>';
            $params  = Input::all();
            $vParams = Dish::validate($params);

            $detailErrors = Dish::getValidationMessages();
            if ($vParams) {
                $fileNames    = array();

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
                    $detailErrors+=DishImage::getValidationMessages();
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
        return $this->layout->main = View::make('admin.dish.edit-dish');
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
            $dish->description = $arrData['description'];
            $dish->updated_at  = new DateTime;
            if(isset($arrData['image_name'])) {
                $dish->image_name = $arrData['image_name'];
            }
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
        $normalSize = Dish::scaleSize($file, Dish::HEIGHT_NORMAL_IMAGE);
        $thumpSize  = Dish::scaleSize($file, Dish::HEIGHT_THUMPS_IMAGE);

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
}
