<?php

class YearFee extends \Eloquent {
	protected $fillable = ['year'];
    protected $table = 'year_fees';
    public function monthFees()
    {
        return $this->hasMany('MonthFee' , 'year_id' , 'id');
    }
}