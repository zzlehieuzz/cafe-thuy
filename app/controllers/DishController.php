<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class DishController extends BaseAdminController {

    /**
     *
     */
    public function index()
    {
        return $this->layout->main = View::make('admin.dish.index');
    }
}
