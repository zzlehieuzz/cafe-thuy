<?php

class DishImage extends Base
{

    protected $table   = 'dish_image';
    public $timestamps = false;

    public function dish() {
        return $this->belongsTo('dish', 'dish_id');
    }

    public static $rules = array(
        'imageFiles' => 'mimes:jpeg,jpg,png|max:1000'
    );
}
