<?php

class YouthMember extends Eloquent
{
    protected $fillable = ['gender' ,'first_name', 'last_name', 'date_of_bird' , 'join_date', 'are_member', 'youth_union_id', 'email', 'student_id', 'status_id'];

    protected $dates = ['join_date' , 'date_of_bird'];
    public function youthUnion()
    {
        return $this->belongsTo('YouthUnion', 'youth_union_id');
    }

    public function typeFee()
    {
        return $this->belongsTo('TypeFee', 'type_id', 'id');
    }

    public function shifts()
    {
        return $this->belongsToMany('Shift', 'shift_youth_member', 'youth_member_id', 'shift_id')->withPivot('absent');
    }

    public function myAccount()
    {
        return $this->belongsTo('User', 'email', 'email');
    }

    public function listCores()
    {
        return $this->belongsToMany('ListCore' , 'core_detail' , 'member_id' , 'list_id')->withPivot('confirm','explain');
    }
    public function competences()
    {
        return $this->belongsToMany('Competence' ,'competence_details' ,'member_id' , 'competence_id')
            ->withPivot( 'prorogue_id')->withTimestamps();
    }
    public function competencesWithFull()
    {
        return $this->belongsToMany('Competence' ,'competence_details' ,'member_id' , 'competence_id')
            ->withPivot( 'prorogue_id')
            ->join('prorogues', 'competence_details.prorogue_id', '=', 'prorogues.id')
            ->select('competences.*', 'prorogues.end AS pivot_end' ,'prorogues.name AS pivot_name' , 'prorogues.start AS pivot_start')
            ->withTimestamps();
    }
    public function executives()
    {
        return $this->belongsToMany('Competence' ,'executive_details' ,'member_id' , 'competence_id')
            ->withPivot( 'school_prorogue_id');
    }
    public function executivesWithFull()
    {
        return $this->belongsToMany('Competence' ,'executive_details' ,'member_id' , 'competence_id')
            ->withPivot( 'school_prorogue_id')
            ->join('school_prorogues', 'executive_details.school_prorogue_id', '=', 'school_prorogues.id')
            ->select('competences.*', 'school_prorogues.end AS pivot_end' ,'school_prorogues.name AS pivot_name' , 'school_prorogues.start AS pivot_start')
            ;
    }


    public function listsCreateFelicitations(){
        return $this->hasMany('ListFelicitation',  'member_id' , 'id');
    }
    public function schoolActivities()
    {
        return $this->morphToMany('SchoolActivity', 'join');
    }
    public function monthFees()
    {
        return $this->morphToMany('MonthFee', 'pay')->withPivot('check');
    }

    public function unionActivities(){
        return $this->belongsToMany('UnionActivity' , 'participators' ,'youth_member_id' , 'union_activity_id' )->withPivot('present');
    }
    public function listFelicitations(){
        return $this->belongsToMany('ListFelicitation' , 'detail_felicitations' ,'member_id' , 'list_id' )->withPivot('suggested','detail','bonus_id');
    }
    public function scopeLike($query, $field , $value )
    {
        return $query->where($field ,'LIKE' , '%'.$value.'%');
    }
    public function scopeNever($query)
    {
        return $query->where('id' ,'never');
    }
    public function scopeJoined($query)
    {
        return $query->where('are_member' ,true);
    }


    public function availCompetence()
    {
        return $this->competencesWithFull()->where('prorogues.end', '>=' ,date('Y-m-d') );
    }

    public function prorogueCompetence($prorogue_id)
    {
        return $this->competencesWithFull()->where('prorogues.id', '=' ,$prorogue_id );
    }
    public function availExecutive()
    {
        return $this->executivesWithFull()->where('school_prorogues.end', '>=' ,date('Y-m-d') );
    }

    public function prorogueExecutive($prorogue_id)
    {
        return $this->executivesWithFull()->where('school_prorogues.id', '=' ,$prorogue_id );
    }
    public function scopeUnion($query, $union_id)
    {
        return $query->whereHas('youthUnion', function($q) use($union_id){
            $q->where('youth_unions.id','=' , $union_id);
        });
    }

}