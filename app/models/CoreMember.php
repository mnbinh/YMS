<?php

class CoreMember extends \Eloquent {
	protected $fillable = ['name' , 'end_date' , 'begin_date' , 'expired_date' ,'description', 'semester_id'];
    protected $table = 'core_members';
    protected $dates = ['begin_date', 'end_date' , 'expired_date'];
    public function semester()
    {
        return $this->belongsTo('Semester' , 'semester_id' , 'id');
    }

    public function listCores()
    {
        return $this->hasMany('ListCore','core_id' , 'id');
    }


    public function listFelicitations(){
        return $this->hasMany('ListFelicitation', 'period_id' , 'id');
    }

    public function coreDetails(){
        return $this->hasManyThrough('CoreDetail','ListCore' , 'core_id' , 'list_id');
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