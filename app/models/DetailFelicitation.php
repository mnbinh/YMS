<?php

class DetailFelicitation extends \Eloquent {
    protected $fillable = ['date' ,'decision_no' , 'detail' , 'suggested' , 'confirm' ,'bonus_id' , 'list_id' , 'member_id'];
    protected $table = 'detail_felicitations';
    protected $dates = ['date'];
    public function honorType()
    {
        return $this->belongsTo('Honor', 'bonus_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo('YouthMember', 'member_id', 'id');
    }
    public function listFelicitation()
    {
        return $this->belongsTo('ListFelicitation', 'list_id', 'id');
    }
    public function scopeConfirm()
    {
        return $this->where('confirm' , '=' , true);
    }
}