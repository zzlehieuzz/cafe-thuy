<?php

class DetailImage extends Base
{
    const WIDTH_NORMAL_IMAGE  = 320;
    const HEIGHT_NORMAL_IMAGE = 480;

    const WIDTH_THUMPS_IMAGE  = 50;
    const HEIGHT_THUMPS_IMAGE = 50;

    const WIDTH_LARGE_IMAGE  = 600;
    const HEIGHT_LARGE_IMAGE = 450;

    const LIMIT_SIZE          = 2000;

    const PATH_FILE = 'detail-image';
    const PATH_LARGE_FILE  = 'large';
    const PATH_NORMAL_FILE = 'normal';
    const PATH_THUMPS_FILE = 'thumps';

    public static $rules = array(
        'file' => 'mimes:jpeg,jpg,png|max:2000000'
    );

    protected $table      = 'detail_image';
    protected $guarded    = ['detail_id'];
    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function detail() {
        return $this->belongsTo('Detail', 'detail_id');
    }

    public static function getPathDetailImage () {
        return Config::get('app.view') . self::PATH_FILE;
    }

    public static function createPath ($fileName) {
        return self::getPathDetailImage() . '/' . $fileName;
    }

    public static function getPathNormalDetailImage () {
        return self::getPathDetailImage() . '/' .self::PATH_NORMAL_FILE;
    }

    public static function createPathNormalDetailImage ($fileName) {
        return self::getPathNormalDetailImage() . '/' . DetailImage::PATH_NORMAL_FILE . '_' . $fileName;
    }

    public static function getPathThumpsDetailImage () {
        return self::getPathDetailImage() . '/' .self::PATH_THUMPS_FILE;
    }

    public static function createPathThumpsDetailImage ($fileName) {
        return self::getPathThumpsDetailImage() . '/' . DetailImage::PATH_THUMPS_FILE . '_' . $fileName;
    }

    public static function getPathLargeDetailImage () {
        return self::getPathDetailImage() . '/' .self::PATH_LARGE_FILE;
    }

    public static function createPathLargeDetailImage ($fileName) {
        return self::getPathLargeDetailImage() . '/' . DetailImage::PATH_LARGE_FILE . '_' . $fileName;
    }

    public static function scaleSize($file, $width, $height) {
        list($w, $h) = getimagesize($file);

        $ratio = $w/$h;

        return array('width' => ceil($height * $ratio), 'height' => $height);
    }
}
