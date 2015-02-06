<?php

class Dish extends Base
{
    const WIDTH_NORMAL_IMAGE  = 400;
    const HEIGHT_NORMAL_IMAGE = 400;

    const WIDTH_THUMPS_IMAGE  = 220;
    const HEIGHT_THUMPS_IMAGE = 220;

    const LIMIT_SIZE          = 2000;

    const PATH_FILE = 'uploads/dish';
    const PATH_ORIGINAL_FILE = 'original';
    const PATH_LARGE_FILE    = 'large';
    const PATH_NORMAL_FILE   = 'normal';
    const PATH_THUMPS_FILE   = 'thump';

    public $timestamps = false;

    public static $rules = array(
        'title'         => 'Required|Between:1,300',
        'price'         => 'Required',
        'category_list' => 'Required'
    );

    protected $table = 'dish';
    protected $primaryKey = 'id';

    public function dishCategories() {
        return $this->hasMany('DishCategory', 'dish_id');
    }

    public function dishImages() {
        return $this->hasMany('DishImage', 'dish_id');
    }

    public static function getPathUpload () {
        return self::PATH_FILE;
    }

    public static function createPath ($fileName) {
        return self::getPathUpload() . '/' . $fileName;
    }

    public static function getPathOriginal () {
        return self::getPathUpload() . '/' .self::PATH_ORIGINAL_FILE;
    }

    public static function createPathOriginal ($fileName) {
        return self::getPathOriginal() . '/' . self::PATH_ORIGINAL_FILE . '_' . $fileName;
    }

    public static function getPathNormal () {
        return self::getPathUpload() . '/' .self::PATH_NORMAL_FILE;
    }

    public static function createPathNormal ($fileName) {
        return self::getPathNormal() . '/' . self::PATH_NORMAL_FILE . '_' . $fileName;
    }

    public static function getPathThump () {
        return self::getPathUpload() . '/' .self::PATH_THUMPS_FILE;
    }

    public static function createPathThump ($fileName) {
        return self::getPathThump() . '/' . self::PATH_THUMPS_FILE . '_' . $fileName;
    }
}
