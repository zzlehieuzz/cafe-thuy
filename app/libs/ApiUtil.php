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
}