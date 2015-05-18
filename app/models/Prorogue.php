<?php

class Prorogue extends \Eloquent {
	protected $fillable = [];
    protected $table = 'prorogues';
    protected $dates = ['start' , 'end'];
    public function competenceDetails()
    {
        $this->hasMany('CompetenceDetails' , 'prorogue_id' , 'id');

    }

}