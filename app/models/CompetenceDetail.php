<?php

class CompetenceDetail extends \Eloquent {
	protected $fillable = [];
    protected $table = 'competence_details';
    public function prorogue()
    {
        return $this->belongsTo('Prorogue' , 'prorogue_id' , 'id');
    }
    public function youthMember(){
        return $this->belongsTo('YouthMember' , 'member_id' , 'id');
    }
    public function youthMemberWithFull()
    {
        return $this->belongsTo('YouthMember' , 'member_id' , 'id')
                     ->join('youth_unions', 'youth_members.youth_union_id', '=', 'youth_unions.id')
                    ->join('type_fees', 'youth_members.type_id', '=', 'type_fees.id')
                    ->select('youth_members.*'  ,'type_fees.name as type_name', 'youth_unions.name AS union_name' , 'youth_unions.union_id AS union_code' );

    }
    public function competence()
    {
        return $this->belongsTo('Competence' , 'competence_id' , 'id');
    }
    public function scopeUnion($query, $union_id)
    {
        return $query->whereHas('youthMemberWithFull', function($q) use($union_id){
            $q->join('youth_unions', 'youth_members.youth_union_id', '=', 'youth_unions.id')
                ->where('youth_unions.id','=' , $union_id);
        });
    }
    public function scopeProrogueId($query , $prorogue_id)
    {
        return $query->where('prorogue_id' , '=' , $prorogue_id);
    }

}