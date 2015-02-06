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
     *
     */
    public function menu()
    {
        $groupMenu = array();

        $dish = Dish::select(
        'dish.id',
        'c.name AS category_name',
        'dc.category_id',
        'title',
        'description',
        'like_num',
        'price')->with('dishImages')
        ->leftjoin('dish_category AS dc', 'dc.dish_id', '=', 'dish.id')
        ->leftjoin('category AS c', 'c.id', '=', 'dc.category_id')
        ->orderBy('dish.like_num', 'DESC')->get();

        if($dish) {
            $dish = $dish->toArray();

            foreach ($dish as $dishItem) {
                $imageUrl = '';
                if(isset($dishItem['dish_images'][0]['image_name']) && ($dishItem['dish_images'][0]['image_name'])) {
                    $imageUrl = asset(Config::get('app.view')) . '/' . Dish::createPathThump($dishItem['dish_images'][0]['image_name']);
                }

                $dishItem['image_url'] = $imageUrl;
                unset($dishItem['dish_images']);

                $groupMenu[$dishItem['category_id']]['category_name'] = $dishItem['category_name'];
                $groupMenu[$dishItem['category_id']][] = $dishItem;
            }
        }

        return $this->layout->main = View::make('guest.home.menu',
            array('groupMenu' => $groupMenu));
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
