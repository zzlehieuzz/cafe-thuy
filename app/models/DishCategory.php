<?php

class DishCategory extends Base
{
    protected $table   = 'dish_category';
    public $timestamps = false;

    public function dish() {
        return $this->belongsTo('dish', 'dish_id');
    }
}
