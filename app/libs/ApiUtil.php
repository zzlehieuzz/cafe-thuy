<?php

/**
 * Config
 * @author HieuNld 2014/01/11
 */

class ApiUtil
{

    /**
     * @return string
     */
    public static function createFileName() {
        $time = microtime(true);

        return sprintf("%s%03d", date('YmdHis', $time), ($time - floor($time)) * 1000);
    }

    /**
     * @param $ext
     * @return string
     */
    public static function createImageName($ext) {
        return self::createFileName() . '.' .$ext;
    }

    /**
     * @param $path
     * @return string
     */
    public static function createDir($path) {
        if (!is_dir($path)) {
            mkdir($path, 0777);
            umask(umask(0));
        }
        $result = true;
        if (!is_dir($path)) {
            $result = false;
        }

        return $result;
    }

    /**
     * @param $params
     * @param $key
     *
     * @return string
     */
    public static function getKeyParam($params, $key) {
        if(empty($params[$key])) {
            $value = null;
        } else $value = $params[$key];

        return $value;
    }

    public static function scaleHeight($file, $height) {
        $result = array();
        if(is_file($file)) {
            list($w, $h) = getimagesize($file);
            $ratio  = $w/$h;
            $result = array('width' => ceil($height * $ratio), 'height' => $height);
        }

        return $result;
    }

    public static function scaleWidth($file, $width) {
        $result = array();
        if(is_file($file)) {
            list($w, $h) = getimagesize($file);
            $ratio = $w / $h;
            $result = array('width' => $width, 'height' => ceil($width * $ratio));
        }

        return $result;
    }

    public static function googleLink($text = '') {
        return sprintf('<a href="https://maps.google.co.jp/maps?hl=ja&amp;q=%s" target="_blank">%s</a>', $text);
    }

}