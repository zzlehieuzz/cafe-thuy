<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class DishController extends BaseGuestController {

    /**
     *
     */
    public function index()
    {
        return $this->layout->main = View::make('admin.dish.index');
    }
}
