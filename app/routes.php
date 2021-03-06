<?php

//App::missing(function($exception) {
//    if(!$exception) {
//        $mess = '404 - Page not Found';
//    } else $mess = $exception;
//
//    return View::make('error/page', array('message' => $mess));
//});

Route::get('/', function() {
    if(BrowserDetect::isMobile() || BrowserDetect::isTablet()){
//        return Redirect::route('mobile-index');
    } else return Redirect::route('home-index');

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
    $menu    = MenuBar::select('name', 'routes')->orderBy('id', 'DESC')->get();
    $arrMenu = array();
    if ($menu) {
        $arrMenu = $menu->toArray();
    }

    $view->with('menuItems', $arrMenu);
});

View::composer('guest.include._featured', function($view){
    $dish    = HomeController::getDish()->take(4)->get();
    $arrDish = array();
    if ($dish) {
        $dish = $dish->toArray();

        foreach ($dish as $key => $dishItem) {
            $imageUrl = '';
            if(isset($dishItem['dish_images'][0]['image_name']) && ($dishItem['dish_images'][0]['image_name'])) {
                $imageUrl = asset(Config::get('app.view')) . '/' . Dish::createPathThump($dishItem['dish_images'][0]['image_name']);
            }

            $arrDish[$key]['id']        = $dishItem['id'];
            $arrDish[$key]['image_url'] = $imageUrl;
        }
    }

    $view->with('dish', $arrDish);
});

View::composer('guest.include._recent_dish', function($view){
    $dish    = HomeController::getDish()->take(5)->get();
    $arrDish = array();
    if ($dish) {
        $dish = $dish->toArray();

        foreach ($dish as $key => $dishItem) {
            $arrDish[$key]['id']          = $dishItem['id'];
            $arrDish[$key]['description'] = $dishItem['description'];
            $arrDish[$key]['title']       = $dishItem['title'];
            $arrDish[$key]['price']       = $dishItem['price'];
        }
    }

    $view->with('dish', $arrDish);
});

Route::group(['prefix' => 'dish/'], function () {
    Route::get('listDish', function () {
        return Redirect::action('DishController@listDish', 1);
    });

    Route::get('/listDish/{page}', array('as' => 'list-dish', 'uses' => 'DishController@listDish'));
    Route::get('/createDish', array('as' => 'get-create-dish', 'uses' => 'DishController@createDish'));
    Route::get('/editDish/{dishId}', array('as' => 'get-edit-dish', 'uses' => 'DishController@editDish'));
    Route::get('/deleteDish/{dishId}', array('as' => 'get-delete-dish', 'uses' => 'DishController@deleteDish'));

    Route::post('/createDish', array('as' => 'post-create-dish', 'uses' => 'DishController@createDish'));
    Route::post('/editDish/{dishId}', array('as' => 'post-edit-dish', 'uses' => 'DishController@editDish'));

    Route::get('/popupAddCategory', array('as' => 'popup-get-dish-add-category', 'uses' => 'DishController@popupAddCategory'));
});

Route::group(['prefix' => 'category/'], function () {
    Route::get('/listCategory', array('as' => 'list-category', 'uses' => 'CategoryController@listCategory'));
    Route::get('/createCategory', array('as' => 'get-create-category', 'uses' => 'CategoryController@createCategory'));
    Route::get('/editCategory/{categoryId}', array('as' => 'get-edit-category', 'uses' => 'CategoryController@editCategory'));
    Route::get('/deleteCategory/{categoryId}', array('as' => 'get-delete-category', 'uses' => 'CategoryController@deleteCategory'));

    Route::post('/createCategory', array('as' => 'post-create-category', 'uses' => 'CategoryController@createCategory'));
    Route::post('/editCategory/{categoryId}', array('as' => 'post-edit-category', 'uses' => 'CategoryController@editCategory'));
});

Route::group(['prefix' => 'home/'], function () {
    Route::get('/index', array('as' => 'home-index', 'uses' => 'HomeController@index'));
    Route::get('/gallery', array('as' => 'home-gallery', 'uses' => 'HomeController@gallery'));
    Route::get('/location', array('as' => 'home-location', 'uses' => 'HomeController@location'));
    Route::get('/menu', array('as' => 'home-menu', 'uses' => 'HomeController@menu'));
    Route::get('/about', array('as' => 'home-about', 'uses' => 'HomeController@about'));
});

Route::group(['prefix' => 'mobile/'], function () {
    Route::get('/', function () {
        return Redirect::action('MobileController@index');
    });

    Route::get('/index', array('as' => 'mobile-index', 'uses' => 'MobileController@index'));
});