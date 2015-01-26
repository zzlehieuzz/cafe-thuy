<?php

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BaseAdminController extends BaseController
{
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
}
