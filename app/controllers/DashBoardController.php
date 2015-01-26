<?php

use Intervention\Image\ImageManagerStatic as SomeUniqueName;

class DashBoardController extends BaseAdminController {

    /**
     *
     */
    public function index()
    {
        return $this->layout->main = View::make('admin.dash-board.index');
    }
}
