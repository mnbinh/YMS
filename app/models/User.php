<?php

use Illuminate\Auth\UserTrait;
use Zizaco\Entrust\HasRole ;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;


class User extends Eloquent implements UserInterface, RemindableInterface , ConfideUserInterface  {

	use  ConfideUser , HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $fillable = ['email' , 'password' , 'username' ,'confirmed'];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    public function youthMember()
    {
      return $this->hasOne('YouthMember', 'email' , 'email');
    }

}
