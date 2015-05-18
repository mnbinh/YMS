<?php

class SchoolProrogue extends \Eloquent {
	protected $fillable = [];
    protected $table = 'school_prorogues';
    protected $dates = ['start' , 'end'];
    public function executiveDetails()
    {
        $this->hasMany('ExecutiveDetails' , 'school_executive_id' , 'id');

    }

}