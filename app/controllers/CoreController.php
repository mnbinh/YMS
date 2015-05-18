<?php

class CoreController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /core
	 *
	 * @return Response
	 */
	public function index()
	{
        $now = Helpers::findSemester();

        $sem = Semester::year($now['year'])->semester($now['semester'])->firstOrFail();
        $core = $sem->coreMember;
        $union = YouthUnion::active()->get();
        $id = $union->first()->id;
        $table =   Datatable::table()
            ->addColumn('Mã Đoàn Viên', 'Họ Tên'  ,'Đối Tượng' ,'Năm Học' ,'Học Kỳ' ,'Thành Tích ', 'Sữa'  )
            ->setUrl(URL::route('table.core' , array('id' => $id , 'year' => $now['year'] , 'semester' => $now['semester'])))
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 25 ,
                "bPaginate" => true,
                "bProcessing"=> true ,
                "oLanguage" => array(
                    "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

     "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'
                ) ,
                "bLengthChange"=> true,
                "dom"=> '<"toolbar">frtip',
                "bFilter"=> true,
                "bSort"=> true,
                "bInfo"=> true,
                "bAutoWidth"=> false))
            ->noScript();



        $years = DB::table('semesters')
            ->select(DB::raw('DISTINCT year'))
            ->get();
        $semesters = DB::table('semesters')
            ->select(DB::raw('DISTINCT semester'))
            ->get();

        return View::make('core.index' , array('core' => $core ,'unions'=>$union ,'table' => $table , 'semesters' => $semesters ,'semester_now' => $now['semester'], 'years' => $years , 'year_now' => $now['year']));
	}
    /**
     *
     */
    public function getDataCoreMember()
    {
        $semester = Semester::year(Input::get('year'))->semester(Input::get('semester'))->firstOrFail();
        $core = $semester->coreMember;
        $union = YouthUnion::find(Input::get('id'));
        $details = YouthMember::never()->get();
            if(isset($core)) {
                $list_core = $union->listCores()->where('core_id', '=', $core->id)->get()->first();
            }
        if (isset($list_core)) {
            $details = $list_core->coreDetails()->with('youthMember')->where('confirm', '=', true)->get();
        }
        return Datatable::collection($details)
            ->showColumns('student_id', 'name', 'are_member', 'year', 'semester', 'explain', 'id')
            ->addColumn('id', function ($model) {
                return '<a href="/honor/' . $model->id . '/edit" class="edit btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> </a>';
            })
            ->addColumn('student_id', function ($model) {

                return $model->youthMember->student_id;

            })

            ->addColumn('name', function ($model) {
                return $model->youthMember->first_name . ' ' . $model->youthMember->last_name;
            })
            ->addColumn('are_member', function ($model) {
                if ($model->youthMember->are_member) {
                    return 'Sinh viên';
                } else {
                    return 'Cán bộ';
                }

            })
            ->addColumn('year', function ($model) use ($semester) {
                return $semester->year;
            })
            ->addColumn('semester', function ($model) use ($semester) {
                return $semester->semester;
            })
            ->addColumn('id', function ($model) {
                $id =$model->id;
                return '<a href="'.URL::route('member.activities' ,array('member_id'=>$id )).'" class="show_activity btn btn-flat btn-info btn-xs">
                    <i class="fa fa-star"></i> Edit</a>';
            })
            ->addColumn('explain' ,function($model){
                return '<div ><a href="#" class="explain btn bnt-flat btn-xs btn-success" ><i class="fa  fa-send"></i> </a>
                        <div class="none">' .
                $model->explain.
                '</div>
                            </div>
                        ';
            })
            ->searchColumns('student_id', 'name')
            ->orderColumns('name', 'student_id')
            ->make();

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /core/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $year = Input::get('year');
        $semester = Input::get('semester');
        $sem = Semester::year($year)->semester($semester)->firstOrFail();
        $core = $sem->coreMember;
        if(isset($core))
        {return Response::json(['msg' => 'success' , 'exist' => true]);}

        $html = View::make('core.create', array('sem' => $sem))->render();
        return Response::json(['msg' => 'success' , 'exist' => false , 'html' => $html]);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /core
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $name = Input::get('name');
        $semester_id = Input::get('semester_id');
        $end_date = Input::get('end_date');
        $begin_date = Input::get('begin_date');
        $expired_date = Input::get('expired_date');
        $description = Input::get('description');
        $core =CoreMember::create(array('name'=>$name ,
            'semester_id'=> $semester_id ,
            'end_date'=>$end_date ,
            'begin_date' => $begin_date ,
            'expired_date'=> $expired_date ,
            'description' => $description ,
        'name' => $name
        ));

        return Response::json(['msg'=> 'success', 'link' => URL::route('core.show' , [$core->id])]);



    }

	/**
	 * Display the specified resource.
	 * GET /core/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $table =   Datatable::table()
            ->addColumn('Mã', 'Họ Tên'  ,'Chi Đoàn','Đối Tượng'  ,'Thành Tích ','Duyệt' )
            ->setUrl( URL::route('ajax.detail.list.appoint', array('core_id' => $id)))
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 25 ,
                "bPaginate" => true,
                "bProcessing"=> true ,
                "oLanguage" => array(
                    "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

     "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'
                ) ,
                "bLengthChange"=> true,
                "dom"=> '<"toolbar">frtip',
                "bFilter"=> true,
                "bSort"=> true,
                "bInfo"=> true,
                "bAutoWidth"=> false))
            ->noScript();
        $core = CoreMember::find($id);
        $semester = $core->semester;
        $lists = $core->listCores;
        return View::make('core.show-core' , array('semester'=> $semester ,'lists'=> $lists ,'core' => $core , 'table' => $table))->render();

    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /core/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /core/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /core/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    /**
     *
     */
    public function createAppoint()
    {
        $lid = Input::get('list_id');
        if($lid == 'default')
        { return Response::json(['msg'=> 'success' , 'exist' => false ]) ; }
        $html = View::make('core.partial.add', array('list_id' => $lid))->render();
        return Response::json(['msg'=> 'success' , 'exist' => true , 'html' => $html]);
    }
    /**
     *
     */
    public function storeListCore()
    {

        $core_id =Input::get('core_id');
        $member = Confide::user()->youthMember;
        $member_id = $member->id;
        $name =  $member->youthUnion->name;
        $l =ListCore::create(array('member_id'=>$member_id , 'core_id' => $core_id ,'name' => $name) );

        return Response::json(array('msg'=>'success' , 'lid' => $l->id ,'link' => URL::route('create.core.member', array('list_id' =>$l->id ))));
    }
    /**
     *
     */
    public function storeSingle($id)
    {
        $list = ListCore::find($id);
        $student_id = Input::get('member_id');
        $member = YouthMember::where('student_id' , $student_id)->firstOrFail();
//        $suggested = Input::get('suggested');
        $explain = Input::get('explain');
//        $bonus_id = Input::get('bonus_id');
        $list->youthMembers()->attach($member, array('explain'=>$explain ));
        return Response::json(array('msg'=>'success' ));
    }
    /**
     *
     */


    public function showCore()
    {
        $cores = CoreMember::all();
        $core =  CoreMember::orderBy('created_at', 'desc')->first();
        $user = Confide::user();
        $union = $user->youthMember->youthUnion;
        $lists =  $union->listCores();
        $my_list = $lists->equal('core_id' ,$core->id )->get();
        $exist = false;
        if($my_list->count()) {
            $exist = true;
        }
        $table =   Datatable::table()
            ->addColumn('Mã Đoàn Viên', 'Họ Tên'  ,'Đối Tượng' ,'Năm Học' ,'Học Kỳ' , 'Sữa', 'Thành Tích', 'Chọn' )
            ->setUrl($exist ? URL::route('table.appoint', array('lid' => $my_list->first()->id)) : URL::route('table.appoint') )
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 25 ,
                "bPaginate" => true,
                "bProcessing"=> true ,
                "oLanguage" => array(
                    "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

     "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>' ,
                    'sEmptyTable'=> 'Danh sách rỗng '
                ) ,
                "bLengthChange"=> true,
                "dom"=> '<"toolbar">frtip',
                "bFilter"=> true,
                "bSort"=> true,
                "bInfo"=> true,
                "bAutoWidth"=> false))
            ->noScript();


//            return View::make('honor.index', array('exist'=>$exist, 'last_period' => $last_period , 'table' => $table));

        return View::make('core.index-core', array('union' => $union ,'core' => $core , 'cores' => $cores ,'exist'=>$exist,'table' => $table  ,'list' => $my_list->first()));

    }
    /**
     *
     */
    public function checkListExist()
    {
        $core_id = Input::get('id');
        $user = Confide::user();
        $union = $user->youthMember->youthUnion;
        $lists =  $union->listCores();
        $my_list = $lists->equal('core_id' ,$core_id )->get();
        $exist = false;
        $lid = "default" ;
        if($my_list->count()) {
            $exist = true;
            $lid =  $my_list->first()->id;
        }
        $link = URL::route('create.core.member', array('list_id' => $lid));
        return Response::json(['msg' => 'success', 'exist' => $exist , 'lid' =>$lid , 'link'=> $link] );
    }
    /**
     *
     */
    public function validateId()
    {
        $uid = Input::has('union_id') ? Input::get('union_id') : 'default' ;
        $core_id = Input::get('core_id');
        $member_id = Input::get('member_id');
        $member = YouthMember::where('student_id', '=' , $member_id)->first();
        if(isset($member) && ($uid == 'default' || $member->youth_union_id == $uid)){
            $core = CoreMember::find($core_id);
            $detail = $core->coreDetails()->where('core_details.member_id' , '=' , $member->id)->get();
            if(!$detail->count())
            {
                return 'true';
            }
        }
        return 'false';
    }
    /**
     *
     */
    public function getDataAppointMember()
    {

        $detail = YouthMember::never()->get();
            $semester = Semester::first();
            if(Input::has('lid')) {
                $lid = Input::get('lid');
                $list = ListCore::find($lid);
                $semester = $list->coreMember->semester;
                $detail = $list->coreDetails()->with('youthMember')->get();;
            }
            return Datatable::collection($detail)
                ->showColumns('student_id', 'name', 'are_member', 'year', 'semester', 'id' ,'explain', 'check')
                ->addColumn('id', function ($model) {
                    return '<a href="/honor/' . $model->id . '/edit" class="edit" ><i class="fa fa-edit"></i> </a>';
                })
                ->addColumn('student_id', function ($model) {

                    return $model->youthMember->student_id;

                })
                ->addColumn('explain' ,function($model){
                    return '<div ><a href="#" class="explain btn bnt-flat btn-xs btn-success" ><i class="fa  fa-send"></i> </a>
                        <div class="none">' .
                         $model->explain.
                        '</div>
                            </div>
                        ';
                })
                ->addColumn('check', function ($model) {
                    return '<input type="checkbox" class="check-multiple" data-id="' . $model->id . '"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>';
                })
                ->addColumn('name', function ($model) {
                    return $model->youthMember->first_name . ' ' . $model->youthMember->last_name;
                })
                ->addColumn('are_member', function ($model) {
                    if ($model->youthMember->are_member) {
                        return 'Sinh viên';
                    } else {
                        return 'Cán bộ';
                    }

                })
                ->addColumn('year', function ($model) use ($semester) {
                    return $semester->year;
                })
                ->addColumn('semester', function ($model) use ($semester) {
                    return $semester->semester;
                })

                ->searchColumns('student_id', 'name')
                ->orderColumns('name', 'student_id')
                ->make();






    }
    /**
     *
     */
    public function getDetailOfList()
    {
        $id = Input::get('core_id');
        $list_id = Input::has('list_id') ? Input::get('list_id') : 'default';
        $core = CoreMember::find($id);
        $members = YouthMember::never()->get();
        $semester = null;
        if(isset($core)) {
            $semester = $core->semester;
            if($list_id == 'default') {
                $members = $core->coreDetails()->with('youthMember', 'listCore')->get();
            }
            else{
                $members = $core->coreDetails()->with('youthMember', 'listCore')->where('list_id' ,'=' ,$list_id )->get();
            }
        }
        return Datatable::collection($members)
            ->showColumns('student_id', 'name','union' , 'are_member', 'explain' ,'check')

            ->addColumn('student_id', function ($model) {

                return $model->youthMember->student_id;

            })
            ->addColumn('union', function ($model) {

                return $model->listCore->name;

            })
            ->addColumn('check', function ($model) {
                return '<input type="checkbox"'.($model->confirm ? "checked" : "").' class="check-multiple" data-did="' . $model->id . '"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>';
            })
            ->addColumn('name', function ($model) {
                return $model->youthMember->first_name . ' ' . $model->youthMember->last_name;
            })
            ->addColumn('are_member', function ($model) {
                if ($model->youthMember->are_member) {
                    return 'Sinh viên';
                } else {
                    return 'Cán bộ';
                }

            })


            ->addColumn('explain', function ($model) use($semester) {
                return '<div ><a href="#" class="explain btn bnt-flat btn-xs btn-success" ><i class="fa  fa-send"></i> </a>
                        <div class="none">' .
                $model->explain.
                '</div>
                            </div>
                        ';
            })
            ->searchColumns('student_id', 'name')
            ->orderColumns('name', 'student_id')
            ->make();
    }
    public function confirmMember()
    {
       $a = DB::table('core_details')
            ->where('id', Input::get('detail_id'))
            ->update(array('confirm' => true));

        return Response::json(['msg' => 'success' , 'a' => $a]);
    }
    public function unConfirmMember()
    {
      $a =  DB::table('core_details')
            ->where('id', Input::get('detail_id'))
            ->update(array('confirm' => false));

        return Response::json(['msg' => 'success' , 'a' => $a]);
    }


}