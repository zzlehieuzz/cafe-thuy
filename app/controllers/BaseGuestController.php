<?php

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BaseGuestController extends BaseController
{
    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'guest';
}
