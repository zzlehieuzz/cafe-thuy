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
}