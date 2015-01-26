<?php

class Detail extends Base
{
    public $timestamps = false;

    public static $rules = array(
        'category_list' => 'Required',
        'road_list'     => 'Required',
        'title'         => 'Required|Between:1,300'
    );

    protected $table = 'detail';
    protected $primaryKey = 'id';

    public function detailImages() {
        return $this->hasMany('DetailImage', 'detail_id');
    }
}
