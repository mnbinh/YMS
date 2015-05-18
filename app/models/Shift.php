<?php

class Shift extends \Eloquent {
	protected $fillable = ['date' , 'time' , 'gate'];
    protected $dates = ['date'];
    public function youthMembers()
    {
        return $this->belongsToMany('YouthMember' , 'shift_youth_member' ,'shift_id' , 'youth_member_id' )->withPivot('absent');;
    }
}