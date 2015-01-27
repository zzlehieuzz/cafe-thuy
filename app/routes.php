<?php

App::missing(function($exception) {
    if(!$exception) {
        $mess = '404 - Page not Found';
    } else $mess = $exception;

    return View::make('error/page', array('message' => $mess));
});

Route::get('/', function() {
    return Redirect::route('home-index');
});

Route::get('/login', function () {
    return Redirect::route('login-index');
});

/* Login routes */
Route::get('login/index', array('as' => 'login-index', 'uses' => 'LoginController@index'));
Route::get('login/login', array('as' => 'login-get', 'uses' => 'LoginController@login'));
Route::get('login/logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));

Route::post('login/login', array('as' => 'login-post', 'uses' => 'LoginController@login'));

/* Home routes */
Route::group(['prefix' => 'admin/'], function () {
    Route::get('/detail/{page}', array('as' => 'admin_detail', 'uses' => 'AdminController@detail'));
    Route::get('/createDetail', array('as' => 'admin_createDetail', 'uses' => 'AdminController@createDetail'));
    Route::get('/editDetail/{detailId}', array('as' => 'admin_editDetail', 'uses' => 'AdminController@editDetail'));
    Route::get('/deleteDetail/{detailId}', array('as' => 'admin_deleteDetail', 'uses' => 'AdminController@deleteDetail'));
    Route::get('/loadCategoryById', array('as' => 'admin_loadCategoryById', 'uses' => 'AdminController@loadCategoryById'));
    Route::get('/loadRoadById', array('as' => 'admin_loadRoadById', 'uses' => 'AdminController@loadRoadById'));

    Route::post('/createDetail', array('as' => 'adminPost_createDetail', 'uses' => 'AdminController@createDetail'));
    Route::post('/editDetail/{detailId}', array('as' => 'adminPost_editDetail', 'uses' => 'AdminController@editDetail'));

    Route::get('detail', function () {
        return Redirect::action('AdminController@detail', 1);
    });

    Route::get('/popupAddCategory', array('as' => 'admin_popupAddCategory', 'uses' => 'AdminController@popupAddCategory'));
    Route::get('/popupAddRoad', array('as' => 'admin_popupAddRoad', 'uses' => 'AdminController@popupAddRoad'));
});

Route::group(['prefix' => 'dash-board/'], function () {
    Route::get('/index', array('as' => 'dash-board-index', 'uses' => 'DashBoardController@index'));

    Route::get('/', function () {
        return Redirect::action('DashBoardController@index');
    });
});

View::composer('guest.include._menu', function($view){
    $menu    = MenuBar::select('name', 'routes')->get();
    $arrMenu = array();
    if ($menu) {
        $arrMenu = $menu->toArray();
    }

    $view->with('menuItems', $arrMenu);
});

View::composer('guest.include._featured', function($view){
    $dish = HomeController::getDish()->take(3)->get();
    if ($dish) {
        $dish = $dish->toArray();
    }

    $view->with('dish', $dish);
});

Route::group(['prefix' => 'dish/'], function () {
    Route::get('/index', array('as' => 'dish-index', 'uses' => 'DishController@index'));

    Route::get('/', function () {
        return Redirect::action('DishController@index');
    });

    Route::get('/createDish', array('as' => 'getCreateDish', 'uses' => 'DishController@createDish'));
    Route::get('/editDish/{id}', array('as' => 'getEditDish', 'uses' => 'DishController@editDish'));
    Route::get('/deleteDish/{id}', array('as' => 'getDeleteDish', 'uses' => 'DishController@deleteDetail'));

    Route::post('/createDish', array('as' => 'postCreateDish', 'uses' => 'DishController@createDish'));
    Route::post('/editDish/{id}', array('as' => 'postEditDish', 'uses' => 'DishController@editDish'));
});

Route::group(['prefix' => 'home/'], function () {
    Route::get('/index', array('as' => 'home-index', 'uses' => 'HomeController@index'));
    Route::get('/gallery', array('as' => 'home-gallery', 'uses' => 'HomeController@gallery'));
    Route::get('/location', array('as' => 'home-location', 'uses' => 'HomeController@location'));
    Route::get('/menu', array('as' => 'home-menu', 'uses' => 'HomeController@menu'));
    Route::get('/about', array('as' => 'home-about', 'uses' => 'HomeController@about'));
});