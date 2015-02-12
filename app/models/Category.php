<?php

class Category extends Base
{
    protected $table = 'category';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public static $rules = array(
        'name'         => 'Required|Between:1,300'
    );
}
