<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Base implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    protected $primaryKey = 'id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('user_name', 'password');

    public static $rules = array(
        'user_name' => 'Required|Between:5,30',
        'password'  => 'Required|Between:5,30'
    );

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        /*Now all lowercase to match $userdata as suggested on SO*/
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value) {}

    public function getRememberTokenName()
    {
        return null; // not supported
    }
}
