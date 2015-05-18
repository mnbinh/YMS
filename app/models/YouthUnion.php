<?php

class YouthUnion extends Eloquent {
	protected $fillable = ['name' , 'active' , 'union_id' , 'type_id'];
    public function youthMembers()
    {
        return $this->hasMany('YouthMember');
    }
    public function listFelicitations()
    {
        return $this->hasManyThrough('ListFelicitation','YouthMember' , 'youth_union_id' , 'member_id');
    }
    public function listCores()
    {
        return $this->hasManyThrough('ListCore','YouthMember' , 'youth_union_id' , 'member_id');
    }
    public function secretaries()
    {
        return $this->belongsToMany('YouthMember' , 'secretary' ,'union_id' , 'secretary_id' )->withTimestamps();;
    }
    public function schoolActivities()
    {
        return $this->morphToMany('SchoolActivity', 'join');
    }
    public function typeFee()
    {
        return $this->belongsTo('TypeFee' , 'type_id' , 'id');
    }
    public function competencesWithMember()
    {
        return $this->hasManyThrough('CompetenceDetail' ,'YouthMember' , 'youth_union_id' , 'member_id')
                    -> join('prorogues', 'competence_details.prorogue_id', '=', 'prorogues.id')
                    -> join('competences', 'competence_details.competence_id', '=', 'competences.id')
                     ->select(  'youth_members.first_name as first_name', 'youth_members.last_name as last_name'  );

    }
    public function pays()
    {
        return $this->hasManyThrough('Pay' , 'YouthMember' , 'youth_union_id' , 'pay_id');
    }
    public  function scopeActive($query)
    {
        return $query->where('active' , true);
    }
    public  function scopeUnionId($query , $union_id)
    {
        return $query->where('union_id' ,'=' , $union_id);

    }


}