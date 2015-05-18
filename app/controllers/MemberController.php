<?php

class MemberController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /member
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $table =   Datatable::table()
            ->addColumn('Stt' ,'Mã Đoàn Viên', 'Họ Tên'  ,'Ngày Sinh' ,'Ngày Vào Đoàn' ,'Tên Chi Doàn' ,'Chuyển SHĐ', 'Sữa' , 'Chọn' )
            ->setUrl( URL::route('data.table.member'))
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 25 ,
                "bPaginate" => true,
                "bProcessing"=> true ,
                "oLanguage" => array(
                    "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

     "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'
                ) ,
                "order"=> [[ 1, 'asc' ]] ,
                "bLengthChange"=> true,
                "dom"=> '<"toolbar">frtip',
                "bFilter"=> true,
                "bSort"=> true,
                "bInfo"=> true,
                "bAutoWidth"=> false))
            ->noScript();
        $lists = YouthUnion::active()->get() ;
        $unions = YouthUnion::active()->lists('name','id');
        $types = TypeFee::lists('name' , 'id');
        return View::make('member.index' , array('types' => $types ,'unions'=> $unions ,'lists' => $lists ,'table' => $table));

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /member/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /member
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        YouthMember::create(Input::all());
        return Response::json(array('msg' =>'success'));
	}

	/**
	 * Display the specified resource.
	 * GET /member/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /member/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $member = YouthMember::find($id);
        $html = View::make('member.edit',array('member'=> $member))->render();
        return Response::json(['msg' => 'success' , 'html'=>$html]);

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /member/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $member = YouthMember::findOrFail($id);
        $member->update(Input::all());


        return Redirect::route('members.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /member/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function getMemberOfUnion($id)
    {
        $activity = UnionActivity::find($id);
        $union = $activity->youthUnion;
        $members = $union->youthMembers()->with(array('unionActivities'  => function ($q) use ($id) {
            $q->equal($id);
        }))->joined()->get();

        $html = View::make('member.partial.list_member', array('members' =>$members , 'id'=> $id))->render();
        return Response::json(array('html'=>$html));

    }
    public function getDataUser()
    {
        $member = YouthMember::never();
        $type = Input::has('type') ? Input::get('type') : 'default';
        $union_id = Input::has('union_id') ? Input::get('union_id') : '0';
        if($type == 'school')
        {
            if($union_id == '0'){
                $member = ExecutiveDetail::schoolProrogueId(2)->with('schoolProrogue', 'youthMemberWithFull')->get();
            }else {
                $member = ExecutiveDetail::union($union_id)->schoolProrogueId(2)->with('schoolProrogue', 'youthMemberWithFull')->get();
            }
        }else if($type == 'class')
        {
            if($union_id == '0'){
                $member = CompetenceDetail::prorogueId(2)->with('prorogue', 'youthMemberWithFull')->get();
            }else {
                $member = CompetenceDetail::union($union_id)->prorogueId(2)->with('prorogue', 'youthMemberWithFull')->get();
            }
        }
         else{
             if($union_id == '0'){
                 $member = YouthMember::with('youthUnion')->get();
             }else {
                 $member = YouthMember::union($union_id)->with('youthUnion')->get();
             }

         }
//        dd($member->toArray());
        return Datatable::collection($member)
            ->showColumns('id' , 'email' ,'name' , 'union' , 'view' ,'check'   )

            ->addColumn('view', function($model){
                if(isset($model->youthMemberWithFull)) {
                    return '<a href="' . URL::route('show.member.role', array('id' => $model->youthMemberWithFull->id)) . '" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-share-square-o"></i> </a>';
                }
                return '<a href="' . URL::route('show.member.role', array('id' => $model->id)) . '" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-share-square-o"></i> </a>';

            })

            ->addColumn('email', function($model){
                if(isset($model->youthMemberWithFull)){
                    return $model->youthMemberWithFull->email;
                }
               return $model->email;
            })
            ->addColumn('name' , function($model){
                if(isset($model->youthMemberWithFull)){
                    return $model->youthMemberWithFull->first_name.' '.$model->youthMemberWithFull->last_name;
                }
                return $model->first_name.' '.$model->last_name;
            })
            ->addColumn('id' , function($model){
                if(isset($model->youthMemberWithFull)){
                    return $model->youthMemberWithFull->student_id;
                }
                return $model->student_id;
            })
            ->addColumn('check' , function($model){
                return '';
            })
            ->addColumn('union' , function($model){
                if(isset($model->youthMemberWithFull)){
                    return $model->youthMemberWithFull->union_name;
                }
                return $model->youthUnion->name ;
            })

            ->searchColumns('email', 'name' , 'union')
            ->orderColumns('union' ,'email', 'name')
            ->make();
    }
    /**
     *
     */
    public function getSearchUser()
    {
        $member = YouthMember::never();
        $union_id = Input::has('union_id') ? Input::get('union_id') : '0';

        $aid = Input::get('activity_id');


            if($union_id == '0'){
                $member = YouthMember::with('schoolActivities')->get();
            }else {
                $member = YouthMember::union($union_id)->with( 'youthUnion','schoolActivities')->get();
            }


//        dd($member->toArray());
        return Datatable::collection($member)
            ->showColumns('id' , 'email' ,'name' , 'union' , 'view' ,'check'   )

            ->addColumn('view', function($model) use ($aid){

                return '<input type="checkbox"'.($model->schoolActivities->count() ? "checked " : " ") . 'class="check-multiple" data-id="'.$model->id.'" data-aid="'.$aid.'">';

            })

            ->addColumn('email', function($model){

                return $model->email;
            })
            ->addColumn('name' , function($model){

                return $model->first_name.' '.$model->last_name;
            })
            ->addColumn('id' , function($model){

                return $model->student_id;
            })
            ->addColumn('check' , function($model){
                return '';
            })
            ->addColumn('union' , function($model){

                return $model->youthUnion->name ;
            })

            ->searchColumns('email', 'name' , 'union')
            ->orderColumns('union' ,'email', 'name')
            ->make();
    }
    /**
     *
     */
    public function searchMember()
    {
        $unions = YouthUnion::active()->lists('name' , 'id');
        $activity_id = Input::get('activity_id');
        array_unshift($unions, 'Tất cả');
        $html = View::make('member.partial.list_search', array('unions'=> $unions , 'activity_id' => $activity_id))->render();
        return Response::json(array('html'=>$html));

    }
    public function listMembersOfActivity()
    {
        $activity = SchoolActivity::find(Input::get('activity_id'));
        $members = $activity->youthMembers()->with('youthUnion')->get();
        $html = View::make('member.partial.members_of_activities', array('members' => $members))->render();
        return Response::json( array('html' => $html));

    }
    /**
     *
     */
    public function getDataTableMember()
    {
        $member = YouthMember::never();
        $union_id = Input::has('union_id') ? Input::get('union_id') : 'default';




        if($union_id == 'default'){
            $member = YouthMember::with('youthUnion')->get();
        }else {
            $member = YouthMember::union($union_id)->with( 'youthUnion')->get();
        }


//        dd($member->toArray());
        return Datatable::collection($member)
            ->showColumns('stt','student_id' ,'name' ,'bird_date' ,'join_date' , 'union' ,'change' ,'edit'  ,'check' )

            ->addColumn('check', function($model) {

                return '<input type="checkbox" class="check-multiple" data-id="'.$model->id.'" >'
             ;

            })

            ->addColumn('name' , function($model){

                return $model->first_name.' '.$model->last_name;
            })
            ->addColumn('student_id' , function($model){

                return $model->student_id;
            })

            ->addColumn('union' , function($model){

                return $model->youthUnion->name ;
            })

            ->addColumn('bird_date' , function($model){

                return $model->date_of_bird->toDateString();
            })
            ->addColumn('join_date' , function($model){

                return $model->join_date->toDateString();
            })
            ->addColumn('change' , function($model){

                return '<a class="btn btn-flat btn-xs btn-danger"><i class="fa fa-mail-forward"></a>' ;
            })
            ->addColumn('edit' , function($model){

                return '<a href="'.URL::route('members.edit',array('id' => $model->id)).'" class="btn btn-flat btn-xs btn-info edit"><i class="fa  fa-edit"></a>' ;
            })
            ->searchColumns(array('last_name', 'union' , 'student_id'))
            ->orderColumns('union' ,'email', 'name')
            ->make();

    }
    /**
     *
     */
    public function createExcel()
    {
        $union_id = Input::has('union_id') ? Input::get('union_id') : 'default';
        $html = View::make('member.partial.create-excel', array('union_id' => $union_id))->render();
        return Response::json(['html' => $html]);
    }
    /**
     *
     */
    public function checkEmailUnique()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'email' => 'unique:youth_members'
            )
        );
        if ($validator->fails())
        {
            return 'false' ;
        }
        return 'true';
    }
    public function checkIdUnique()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'student_id' => 'unique:youth_members'
            )
        );
        if ($validator->fails())
        {
            return 'false' ;
        }
        return 'true';
    }
    /**
     *
     */
    /**
     *
     */
    public function getDataMember()
    {
        $term = Input::get('term');
        $uid= Input::has('union') ? Input::get('union') : 'default';
        if( $uid != 'default') {
            $union = YouthUnion::find($uid);
            $results = $union->youthMembers()->with('youthUnion')->like('student_id', $term)->get();
        }else
        {
            $results = YouthMember::with('youthUnion')->like('student_id', $term)->get();
        }
        $res = array();
        foreach($results as $re){
            array_push($res , array('value'=>$re->student_id  ,'union' => "Chi Đoàn: ".$re->youthUnion->name, 'label' =>$re->first_name.' '.$re->last_name));
        }
        return Response::json($res ,200, array(), JSON_UNESCAPED_UNICODE );


    }

}