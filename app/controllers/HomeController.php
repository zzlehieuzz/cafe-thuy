<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class HomeController extends BaseGuestController {

    /**
     *
     */
    public function index()
    {
        return $this->layout->main = View::make('guest.home.index');
    }

    public function gallery()
    {
        return $this->layout->main = View::make('guest.home.gallery');
    }


    /**
     * @param $categoryId
     *
     * @return \Illuminate\View\View
     */
    public function menu($categoryId = null)
    {
        $groupMenu = array();

        $category = Category::orderBy('id')->lists('name','id');

        $dish = Dish::select(
            'dish.id',
            'dc.category_id',
            'title',
            'description',
            'like_num',
            'price')->with('dishImages')
            ->leftjoin('dish_category AS dc', 'dc.dish_id', '=', 'dish.id')
            ->orderBy('dc.category_id');

        if (Request::isMethod('get')) {
            if($categoryId) {
                $dish->where('dc.category_id', $categoryId);
            }
        }

        $dish = $dish->get();

        if($dish) {
            $dish = $dish->toArray();

            foreach ($dish as $dishItem) {
                $imageUrl = '';
                if(isset($dishItem['dish_images'][0]['image_name']) && ($dishItem['dish_images'][0]['image_name'])) {
                    $imageUrl = asset(Config::get('app.view')) . '/' . Dish::createPathThump($dishItem['dish_images'][0]['image_name']);
                }

                $dishItem['image_url'] = $imageUrl;
                unset($dishItem['dish_images']);

                $groupMenu[] = $dishItem;
            }
        }

        return $this->layout->main = View::make('guest.home.menu',
            array('groupMenu' => $groupMenu,
                  'category' => $category));
    }

    public static function getDish() {
        return Dish::select(
            'dish.id',
            'title',
            'description',
            'like_num',
            'price')->with('dishImages')
            ->orderBy('dish.like_num', 'DESC');
    }

    /**
     *
     */
    public function location()
    {
        return $this->layout->main = View::make('guest.home.location');
    }

    /**
     *
     */
    public function about()
    {
        return $this->layout->main = View::make('guest.home.about');
    }
}
