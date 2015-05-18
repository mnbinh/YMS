<?php

class MonthFee extends \Eloquent {
	protected $fillable = ['year' , 'month' , 'fee' , 'type_id'];
    protected $table = 'month_fees';
    public function youthMembers()
    {
        return $this->morphedByMany('YouthMember', 'pay')->withPivot('check');
    }
    public function typeFee()
    {
        return $this->belongsTo('TypeFee' , 'type_id' , 'id') ;
    }
    public function  yearFee()
    {
        return $this->belongsTo('YearFee' , 'year_id' , 'id') ;
    }
    public function scopeGroupByTypeFee($query )
    {
        return $query->groupBy('type_id');
    }
    public function scopeYear($query, $year_id )
    {
        return $query->where('year_id' , $year_id);
    }
    public function scopeMonth($query, $month )
    {
        return $query->where('month' , $month);
    }
    public function scopeTypeFee($query, $id )
    {
        return $query->where('type_id' , $id);
    }



}