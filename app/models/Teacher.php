<?php

class Teacher extends \Eloquent {
	protected $fillable = ['first_name' , 'last_name' , 'email' , 'bird_date' , 'teacher_id'];
    protected $table = 'teachers';
    protected $dates = ['bird_date'] ;
}