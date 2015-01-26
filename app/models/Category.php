<?php

class Category extends Base
{

    const BAG       = 1;
    const HOME      = 2;
    const TRUCK     = 3;
    const PEOPLE    = 4;
    const PROTECT   = 5;
    const AIR_PLANE = 6;
    const NOTICE    = 7;

    protected $table = 'category';

    protected $primaryKey = 'id';
}
