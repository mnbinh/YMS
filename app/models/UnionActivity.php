<?php

class UnionActivity extends \Eloquent {
    protected $fillable = ['description' , 'time' , 'confirm' , 'place' , 'semester_id' , 'youth_union_id' , 'name'];
    protected $dates = ['time'];
    protected  $table = 'union_activities';

    public function youthUnion()
    {
        return $this->belongsTo('YouthUnion', 'youth_union_id' , 'id');
    }
    public function semester(){
        return $this->belongsTo('Semester', 'semester_id', 'id');
    }
    public function youthMembers(){
        return $this->belongsToMany('YouthMember' , 'participators'  , 'union_activity_id' ,'youth_member_id' )->withPivot('present');
    }
    public function scopeConfirm($query)
    {
        return $query->where('confirm', '=', true);
    }
    public function scopeEqual($query,$id)
    {
        return $query->whereRaw('union_activities.id = ?', array($id));
    }
    public function scopeForward($query)
    {
        return $query->where('time' , '>' , date("Y-m-d") );
    }
    public function scopeCurrentAndPast($query)
    {
        return $query->where('time' , '<=' , date("Y-m-d") );
    }
    public function scopeSemesterId($query , $id)
    {
        return $query->where('semester_id' , '=' ,$id );
    }




}