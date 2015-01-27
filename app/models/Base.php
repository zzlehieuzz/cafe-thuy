<?php

class Base extends Eloquent
{
    const IS_ACTIVE = 1;

    public static $validationMessages = null;

    public static function getValidationMessages() {
        return self::$validationMessages;
    }

    public static function validate($input = null) {
        if (is_null($input)) {
            $input = Input::all();
        }

        $v = Validator::make($input, static::$rules);

        if ($v->passes()) {
            return true;
        } else {
            // save the input to the current session
            Input::flash();
            self::$validationMessages = $v->messages()->getMessages();
            return false;
        }
    }

    public function scopeIsActive($query)
    {
        return $query->where($this->table .'.is_active', self::IS_ACTIVE);
    }

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery();//->isActive();
    }

    public static function queryPager($query, $page = 1, $limit = 30)
    {
        return $query->skip($limit * ($page - 1))->take($limit);
    }

    public static function pager($query, $page = 1, $limit = 30)
    {
        $count = $query->get()->count();

        if ($count <= $limit) {
            $totalPage = 1;
        } else {
            $totalPage = ceil($query->get()->count() / $limit);
        }
        $data = self::queryPager($query, $page, $limit)->get();


        return array('totalPage' => $totalPage, 'totalItems' => $count, 'data' => $data);
    }

    /*
     * @params $query
     * @params $page
     * @params $limit
     *
     * return array
     * */
    public function scopeGetPager($query, $page = 1, $limit = 30)
    {
        $count = $query->get()->count();

        if ($count <= $limit) {
            $totalPage = 1;
        } else {
            $totalPage = ceil($query->get()->count() / $limit);
        }
        $data = self::queryPager($query, $page, $limit)->get();

        return array('totalPage' => $totalPage, 'totalItems' => $count, 'data' => $data);
    }
}
