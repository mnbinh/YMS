<?php

class CoreDetail extends \Eloquent {
	protected $fillable = ['explain', 'confirm' ,'list_id' , 'member_id'];
    protected $table = 'core_details';
    public function youthMember()
    {
        return $this->belongsTo('YouthMember', 'member_id', 'id');
    }
    public function listCore()
    {
        return $this->belongsTo('ListCore', 'list_id', 'id');
    }
    public function scopeConfirm()
    {
        return $this->where('confirm' , '=' , true);
    }
}