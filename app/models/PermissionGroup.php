<?php

class PermissionGroup extends \Eloquent {
	protected $fillable = [];
    protected $table = 'permission_groups';
    public function permissions()
    {
        return $this->hasMany('Permission', 'permission_group_id' , 'id');
    }
}