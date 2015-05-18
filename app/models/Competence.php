<?php

class Competence extends \Eloquent {
	protected $fillable = ['name' , 'code'];
    protected $table = 'competences';
   public function youthMembers()
   {
       return $this->belongsToMany('YouthMember' , 'competence_details' , 'competence_id' , 'member_id')
           ->withPivot( 'prorogue_id')->withTimestamps();
   }


   public function youthMembersWithFull()
   {
       return $this->belongsToMany('YouthMember' , 'competence_details' , 'competence_id' , 'member_id')
           ->withPivot( 'prorogue_id')
           ->join('prorogues', 'competence_details.prorogue_id', '=', 'prorogues.id')
           ->select('youth_members.*', 'prorogues.end AS pivot_end' ,'prorogues.name AS pivot_name', 'prorogues.start AS pivot_start')
           ->withTimestamps();
   }
    public function youthMembersS()
    {
        return $this->belongsToMany('YouthMember' , 'executive_details' , 'competence_id' , 'member_id')
            ->withPivot( 'school_prorogue_id');
    }


    public function youthMembersWithFullS()
    {
        return $this->belongsToMany('YouthMember' , 'executive_details' , 'competence_id' , 'member_id')
            ->withPivot( 'school_prorogue_id')
            ->join('school_prorogues', 'executive_details.school_prorogue_id', '=', 'school_prorogues.id')
            ->select('youth_members.*', 'school_prorogues.end AS pivot_end' ,'school_prorogues.name AS pivot_name', 'school_prorogues.start AS pivot_start');
    }

}