<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class CategoryController extends BaseAdminController {

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function listCategory()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $result   = array();
        if($category) {
            $result = $category->toArray();
        }

        return $this->layout->main = View::make('admin.category.list-category',
            array('category' => $result));
    }

    /**
     *
     */
    public function createCategory()
    {
        if (Request::isMethod('post')) {
            $params  = Input::all();
            $vParams = Category::validate($params);

            $errors = Category::getValidationMessages();
            if ($vParams) {
                $category = new Category();
                $result = $this->processCategory($category, $params);
                if ($result) {
                    return Redirect::to('dish/createCategory')->withSuccess('Your dish was added with success.')->withInput();
                }

            }

            return Redirect::to('category/createCategory')->withErrors($errors)->withInput();
        }

        return $this->layout->main = View::make('admin.category.create-category');
    }

    /**
     * @param $categoryId
     * @return \Illuminate\View\View
     */
    public function editCategory($categoryId)
    {
        $category = Category::where('id', $categoryId)->first();
        $route    = 'category/editCategory/';
        if ($category) {
            if (Request::isMethod('post')) {
                $params  = Input::all();
                $vParams = Category::validate($params);
                $errors  = Category::getValidationMessages();
                if ($vParams) {
                    $result = $this->processCategory($category, $params);
                    if ($result) {
                        return Redirect::to($route . $categoryId)->withSuccess('Your category was updated with success.')->withInput();
                    }
                }

                return Redirect::to($route . $categoryId)->withErrors($errors)->withInput();
            }

            return $this->layout->main = View::make('admin.category.edit-category')
                ->with('category', $category);
        }

        return Redirect::to('category/listCategory');
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
     * @param Category $category
     * @param $params
     *
     * @return bool
     */
    private function processCategory(Category $category, $params) {
        $arrData = array(
            'name'       => ApiUtil::getKeyParam($params, 'name'),
            'parent_id'  => null
        );

        if ($id = $category->id) {
            $category->name = $arrData['name'];
            $category->update();
        } else Category::insert($arrData);

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
