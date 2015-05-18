<?php

class Pay extends \Eloquent {
	protected $fillable = [];
    protected $table = 'pays' ;
    public function monthFee()
    {
        return $this->belongsTo('MonthFee' , 'month_fee_id' , 'id');
    }
    public function scopePayType($query , $type)
    {
        return $query->where('pay_type' , $type);
    }
    public function scopeCheck($query)
    {
        return $query->where('check' , true);
    }
}