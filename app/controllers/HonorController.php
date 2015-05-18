<?php

class HonorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /honor
	 *
	 * @return Response
	 */
	public function indexAdmin()
	{
       $now = Helpers::findSemester();

        $sem = Semester::year($now['year'])->semester($now['semester'])->firstOrFail();
        $periods = $sem->periods;
        $id = $periods->first()->id ;
        $table =   Datatable::table()
            ->addColumn('Mã Đoàn Viên', 'Họ Tên'  ,'Đối Tượng' ,'Năm Học' ,'Học Kỳ' ,'Số Quyết Định' ,'Ngày Quyết Định','Loại', 'Sữa'  )
            ->setUrl( URL::route('data.honor', array('id' => $id)))
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

		return View::make('honor.admin.index' , array('periods'=>$periods , 'table' => $table,'semesters' => $semesters ,'semester_now' => $now['semester'], 'years' => $years , 'year_now' => $now['year']));
	}

    /**
     * @return mixed
     */
    public function index()
    {
        $user = Confide::user();
        $union = $user->youthMember->youthUnion;
        $lists =  $union->listFelicitations()->get()->lists('period_id');

        if (Request::ajax())
        {
            $type = Input::get('type');
            $periods = Period::exp()->get();
            if($type == 'available'){
                $periods = Period::notExp()->get();
            }
            $html = View::make('honor.partial.period-appoint' , array('lists' => $lists,'periods' => $periods))->render();
            return Response::json(['html' => $html]);
        }
        $periods = Period::notExp()->get();

//            return View::make('honor.index', array('exist'=>$exist, 'last_period' => $last_period , 'table' => $table));

        return View::make('honor.index', array('lists' => $lists ,'periods'=>$periods));
    }
    /**
     *
     */
    public function showList($id)
    {
        $type = Honor::lists('name','id');
        $user = Confide::user();
        $union = $user->youthMember->youthUnion;
        $period = Period::find($id);
        $lists =  $union->listFelicitations();
        $my_list = $lists->equal('period_id' ,$period->id )->get();
        $exist = false;
        if($my_list->count()) {
            $exist = true;
        }
        $table =   Datatable::table()
            ->addColumn('Mã Đoàn Viên', 'Họ Tên'  ,'Đối Tượng' ,'Năm Học' ,'Học Kỳ' ,'Đơn vị đề nghị ','Loại', 'Sữa' , 'Chọn' )
            ->setUrl($exist ? URL::route('data.honor', array('lid' => $my_list->first()->id)) : URL::route('data.honor') )
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

        return View::make('honor.show-list', array('period' => $period ,'exist'=>$exist,'table' => $table ,'type' => $type ,'list' => $my_list->first()));

    }

    /**
     * @return mixed
     */
    public  function getMembersDataTableAdmin()
    {

    }
    public function getMembersDataTable()
    {
        if(Input::has('id')) {
            $id = Input::get('id');
            $period = Period::find($id);
            $members = YouthMember::never()->get();
            $semester = null;
            if(isset($period)) {
                $semester = $period->semester;
                $members = $period->detailFelicitations()->with('member', 'honorType', 'listFelicitation')->where('confirm' , '=' , true)->get();
            }
            return Datatable::collection($members)
                ->showColumns('student_id', 'name', 'are_member', 'year', 'semester', 'decision_no','date', 'type', 'id')
                ->addColumn('id', function ($model) {
                    return '<a href="/honor/' . $model->id . '/edit" class="edit btn btn-flat btn-xs btn-info" ><i class="fa fa-edit"></i> </a>';
                })
                ->addColumn('date', function ($model) {

                    return isset($model->date) ? $model->date->toDateString() : '';

                })
                ->addColumn('student_id', function ($model) {

                    return $model->member->student_id;

                })
//                ->addColumn('check', function ($model) {
//                    return '<input type="checkbox" class="check-multiple" data-did="' . $model->id . '"> <script type="text/javascript">
//         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
//</script>';
//                })
                ->addColumn('name', function ($model) {
                    return $model->member->first_name . ' ' . $model->member->last_name;
                })
                ->addColumn('are_member', function ($model) {
                    if ($model->member->are_member) {
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
                ->addColumn('type', function ($model) {
                    return $model->honorType->name;
                })
                ->addColumn('activity', function ($model) use($semester) {
                    $id =$model->member->id;
                    return '<a href="'.URL::route('member.activities' ,array('member_id'=>$id , 'semester_id'=> $semester->id)).'" class="show_activity btn btn-flat btn-info btn-xs">
                    <i class="fa fa-star"></i> Show</a>';
                })
                ->searchColumns('student_id', 'name')
                ->orderColumns('name', 'student_id')
                ->make();
        }
        else
        {
            $members = YouthMember::never()->get();
            $semester = Semester::first();
            if(Input::has('lid')) {
            $lid = Input::get('lid');
            $list = ListFelicitation::find($lid);
            $semester = $list->period->semester;
            $members = $list->youthMembers;
        }
            return Datatable::collection($members)
                ->showColumns('student_id', 'name', 'are_member', 'year', 'semester', 'suggested', 'type', 'id', 'check')
                ->addColumn('id', function ($model) {
                    return '<a href="/honor/' . $model->id . '/edit" class="edit" ><i class="fa fa-edit"></i> </a>';
                })
                ->addColumn('student_id', function ($model) {

                    return $model->student_id;

                })
                ->addColumn('check', function ($model) {
                    return '<input type="checkbox" class="check-multiple" data-id="' . $model->id . '"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>';
                })
                ->addColumn('name', function ($model) {
                    return $model->first_name . ' ' . $model->last_name;
                })
                ->addColumn('are_member', function ($model) {
                    if ($model->are_member) {
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
                ->addColumn('suggested', function($model){
                    return $model->pivot->suggested;
                })
                ->addColumn('type', function ($model) {
                    return $model->pivot->bonus_id;
                })
                ->searchColumns('student_id', 'name')
                ->orderColumns('name', 'student_id')
                ->make();




        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function storeSingle($id)
    {
        $list = ListFelicitation::find($id);
        $student_id = Input::get('member_id');
        $member = YouthMember::where('student_id' , $student_id)->firstOrFail();
        $suggested = Input::get('suggested');
        $detail = Input::get('detail');
        $bonus_id = Input::get('bonus_id');
        $list->youthMembers()->attach($member, array('suggested'=> $suggested,'detail'=>$detail ,'bonus_id'=>$bonus_id));
        return Response::json(array('msg'=>'success' ));
    }
    /**
     *
     */
    public function storeSingleAdmin()
    {
        $period_id = Input::get('period_id');
        $member_id = Confide::user()->youthMember->id;
        $list = ListFelicitation::firstOrCreate(array('period_id' => $period_id ,'member_id' => $member_id , 'name' => 'Danh Sách Bổ Sung'));
        $student_id = Input::get('member_id');
        $member = YouthMember::where('student_id' , $student_id)->firstOrFail();
        $suggested = Input::get('suggested');
        $detail = Input::get('detail');
        $bonus_id = Input::get('bonus_id');
        $list->youthMembers()->attach($member, array('suggested'=> $suggested,'detail'=>$detail ,'bonus_id'=>$bonus_id , 'confirm' => true));
        return Response::json(array('msg'=>'success' ));
    }
    /**
     *
     */
    public function validateId()
    {

        $period_id = Input::get('period_id');
        $member_id = Input::get('member_id');
        $member = YouthMember::where('student_id', '=' , $member_id)->first();
        if(isset($member)){
            $period = Period::find($period_id);
            $detail = $period->detailFelicitations()->where('detail_felicitations.member_id' , '=' , $member->id)->get();
            if(!$detail->count())
            {
                return 'true';
            }
        }
        return 'false';
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /honor/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $html = View::make('honor.admin.new')->render();
        return Response::json(array('html'=>$html));
	}
    /**
     *
     */
    public function newListHonor()

    {
        $pid = \Illuminate\Support\Facades\Input::get('period_id');
        $member = Confide::user()->youthMember;
        $member_id = $member->id;
        $name =  $member->youthUnion->name;
        $l =ListFelicitation::create(array('member_id'=>$member_id , 'period_id' => $pid ,'name' => $name) );

        return Response::json(array('msg'=>'success' , 'lid' => $l->id ,'link' => URL::route('store.single', array('id' =>$l->id ))));

    }


    /**
     *
     */
    public function storePeriod()
    {

        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $name = Input::get( 'name' );
        $begin_date = Input::get( 'begin_date' );
        $end_date = Input::get( 'end_date' );
        $expired_date = Input::get('expired_date');
        $description = Input::get('description');

        $period = Period::create(array('expired_date' => $expired_date ,'name'=>$name , 'semester_id' => 5 , 'begin_date'=>$begin_date , 'end_date'=>$end_date ,'description' => $description ));
        //.....
        //validate data
        //and then store it in DB
        //.....

        $html = View::make('honor.partial.periods-added', array('period'=>$period))->render();



        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
            'html'=> $html
        );

        return Response::json( $response );

    }

	/**
	 * Store a newly created resource in storage.
	 * POST /honor
	 *
	 * @return Response
	 */

	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 * GET /honor/{id}
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
	 * GET /honor/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $detail = DetailFelicitation::find($id);
        $html = View::make('honor.edit-detail', array('detail'=> $detail))->render();
        return Response::json(['html' => $html]);

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /honor/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        DB::table('detail_felicitations')->where('id' , $id)->update(['decision_no'=> Input::get('decision_no') ,
          'date' => Input::has('date') ? Input::get('date') : null, 'suggested' => Input::get('suggested')]);
        return Response::json(['msg' => 'success']);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /honor/{id}
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
    public function confirmMember()
    {
        DB::table('detail_felicitations')
            ->where('id', Input::get('detail_id'))
            ->update(array('confirm' => true));

        return Response::json(['msg' => 'success']);
    }
    public function unConfirmMember()
    {
        DB::table('detail_felicitations')
            ->where('id', Input::get('detail_id'))
            ->update(array('confirm' => false));

        return Response::json(['msg' => 'success']);
    }

    /**
     *
     */
    public function getPeriodsBySemester()
    {
        $semester = Input::get('semester');
        $year = Input::get('year');
//
        $sem = Semester::year($year)->semester($semester)->firstOrFail();
        $periods = $sem->periods;
        $html = View::make('honor.partial.periods-option', array('periods'=> $periods))->render();
        return Response::json(array('html'=> $html , 'msg' => 'success'));

    }
    /**
     *
     */
    public function indexPeriod()

    {
        $type = Input::has('type') ? Input::get('type') : 'available' ;
        if($type == 'available') {
            $periods = Period::notExp()->get();
        }
        else
        {
            $periods = Period::exp()->get();
        }

        if (Request::ajax())
        {
            $html = View::make('honor.partial.type-period' ,array('periods' => $periods))->render();
            return Response::json(array('html'=> $html));
        }

        return View::make('honor.admin.index-period', array('periods'=>$periods));

    }
    /**
     *
     */

    public function showPeriod($id)
    {
        $table =   Datatable::table()
            ->addColumn('Mã', 'Họ Tên'  ,'Chi Đoàn','Đối Tượng'  ,'Hoạt Động ','Duyệt' )
            ->setUrl( URL::route('ajax.detail.of.list', array('period_id' => $id)))
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
        $period = Period::find($id);
        Event::fire('periods.view', $period);
        $semester = $period->semester;
        $lists = $period->listFelicitations;
        return View::make('honor.admin.show-period' , array('semester'=> $semester ,'lists'=> $lists ,'period' => $period , 'table' => $table))->render();

    }
    /**
     *
     */

    public function editPeriod($id)
    {
        $period = Period::find($id);
        $html = View::make('honor.edit', array('period' => $period))->render();
        return Response::json(['html' => $html]);

    }
    /**
     *
     */
    public function updatePeriod($id)
    {
        $period = Period::findOrFail($id);
        $period->update(Input::all());


        return Redirect::route('index.admin.period');
    }
    /**
     *
     */
    public function destroyPeriod()
    {

    }

    /**
     *
     */
    public function getDetailOfList()
    {
        $id = Input::get('period_id');
        $list_id = Input::has('list_id') ? Input::get('list_id') : 'default';
        $period = Period::find($id);
        $members = YouthMember::never()->get();
        $semester = null;
        if(isset($period)) {
            $semester = $period->semester;
            if($list_id == 'default') {
                $members = $period->detailFelicitations()->with('member', 'honorType', 'listFelicitation')->get();
            }
            else{
                $members = $period->detailFelicitations()->with('member', 'honorType', 'listFelicitation')->where('list_id' ,'=' ,$list_id )->get();
            }
        }
        return Datatable::collection($members)
            ->showColumns('student_id', 'name','union' , 'are_member', 'activity' ,'check')

            ->addColumn('student_id', function ($model) {

                return $model->member->student_id;

            })
            ->addColumn('union', function ($model) {

                return $model->listFelicitation->name;

            })
                ->addColumn('check', function ($model) {
                    return '<input type="checkbox"'.($model->confirm ? "checked" : "").' class="check-multiple" data-did="' . $model->id . '"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>';
                })
            ->addColumn('name', function ($model) {
                return $model->member->first_name . ' ' . $model->member->last_name;
            })
            ->addColumn('are_member', function ($model) {
                if ($model->member->are_member) {
                    return 'Sinh viên';
                } else {
                    return 'Cán bộ';
                }

            })


            ->addColumn('activity', function ($model) use($semester) {
                $id =$model->member->id;
                return '<a href="'.URL::route('member.activities' ,array('member_id'=>$id , 'semester_id'=> $semester->id)).'" class="show_activity btn btn-flat btn-info btn-xs">
                    <i class="fa fa-star"></i> Show</a>';
            })
            ->searchColumns('student_id', 'name')
            ->orderColumns('name', 'student_id')
            ->make();
    }

    public function getAddForm()
    {
        $period_id = Input::get('period_id');
        $type = Honor::lists('name','id');
        $html = View::make('honor.partial.add', array('type' => $type , 'period_id' => $period_id))->render();
        return Response::json(array('html' => $html));
    }


}