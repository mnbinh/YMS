<?php

class ListFelicitation extends \Eloquent {
	protected $fillable = ['name' , 'period_id' , 'is_sent' , 'is_confirm' , 'member_id'];
    protected  $table = 'list_felicitations';
    public function youthMember()
    {
        return $this->belongsTo('YouthMember', 'member_id' , 'id');
    }
    public function period()
    {
        return $this->belongsTo('Period', 'period_id' , 'id');
    }
    public  function youthMembers()
    {
        return $this->belongsToMany('YouthMember' , 'detail_felicitations' ,'list_id' , 'member_id' )->withPivot('confirm' ,'suggested','detail','bonus_id');
    }
    public function scopeEqual($query, $field , $value )
    {
        return $query->where($field , $value);
    }
}