<?php

class ListCore extends \Eloquent {
	protected $fillable = ['name' , 'core_id' , 'is_sent' , 'is_confirm' , 'member_id'];
    protected $table = 'list_cores';
    public function youthMembers()
    {
        return $this->belongsToMany('YouthMember' , 'core_details' , 'list_id' , 'member_id')->withPivot('confirm','explain');
    }
    public function coreDetails()
    {
        return $this->hasMany('CoreDetail' , 'list_id' , 'id' );
    }
    public function youthMember()
    {
        return $this->belongsTo('YouthMember', 'member_id' , 'id');
    }
    public function coreMember()
    {
        return $this->belongsTo('CoreMember', 'core_id' , 'id');
    }

    public function scopeEqual($query, $field , $value )
    {
        return $query->where($field , $value);
    }
}