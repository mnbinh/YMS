<?php

class Period extends \Eloquent {
    protected $fillable = ['view_counter' ,'name' , 'semester_id' , 'expired' , 'end_date' , 'begin_date' , 'description' , 'expired_date'];
    protected $table = 'periods';
    protected $dates = ['end_date' , 'begin_date' , 'expired_date'];

    public function listFelicitations(){
        return $this->hasMany('ListFelicitation', 'period_id' , 'id');
    }

    public function detailFelicitations(){
        return $this->hasManyThrough('DetailFelicitation','ListFelicitation' , 'period_id' , 'list_id');
    }
    public function semester(){
        return $this->belongsTo('Semester', 'semester_id', 'id');
    }
    public function scopeExp($query){
        return $query->where('expired_date' , '<' , date("Y-m-d") );
    }
    public function scopeNotExp($query){
        return $query->where('expired_date' , '>' , date("Y-m-d") );
    }
    public function scopeOrderByCreated($query){
        return $query->orderBy('created_at', 'DESC');
    }

}