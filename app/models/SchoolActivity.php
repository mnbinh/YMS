<?php

class SchoolActivity extends \Eloquent {
	protected $fillable = ['description' , 'is_union', 'date' , 'expired_date' , 'place' , 'name' , 'semester_id'];
    protected  $table = 'school_activities';
    protected $dates = ['date' , 'expired_date'];
    public function semester()
    {
        return $this->belongsTo('Semester','semester_id' , 'id');
    }

    public function youthMembers()
    {
        return $this->morphedByMany('YouthMember', 'join');
    }
        public function youthUnions()
    {
        return $this->morphedByMany('YouthUnion', 'join');
    }
    public function scopeUnion($query)
    {
        return $query->where('is_union', '=' , true);
    }
    public function scopeMember($query)
    {
        return $query->where('is_union', '=' , false);
    }
    public function scopeAvailable($query)
    {
        return $query->where('expired_date' , '>' , date("Y-m-d") );
    }
    public function scopeSemesterId($query , $id)
    {
        return $query->where('semester_id' , '=' ,$id );
    }


}