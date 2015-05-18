<?php

class TypeCompetence extends \Eloquent {
	protected $fillable = [];
    protected  $table = 'type_competences' ;
    public function competences()
    {
      return  $this->hasMany('Competence' , 'type_id' , 'id');
    }
    public function scopeName($query ,$name)
    {
        return $query->where('name' , '=' , $name);
    }
}