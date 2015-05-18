<?php

class Semester extends \Eloquent {
	protected $fillable = ['year' , 'semester'];
    protected $table = 'semesters';
    public function periods()
    {
        return$this->hasMany('Period' , 'semester_id' , 'id');
    }
    public function coreMember()
    {
        return $this->hasOne('CoreMember','semester_id' , 'id');
    }
    public function schoolActivities()
    {
        return $this->hasMany('SchoolActivity','semester_id' , 'id');
    }
    public function unionActivities()
    {
        return $this->hasMany('UnionActivity','semester_id' , 'id');
    }
    public function scopeYear($query , $year)
    {
        return $query->where('year' ,'=' , $year);
    }
    public function scopeSemester($query , $semester)
    {
        return $query->where('semester' ,'=' , $semester);
    }

}