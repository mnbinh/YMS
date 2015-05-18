<?php
use Carbon\Carbon ;
class ActivityController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 * GET /activity
	 *
	 * @return Response
	 */
	public function index()
	{

        $now = Carbon::now();
        $f_activities = UnionActivity::forward()->get();
        $cc_activities = UnionActivity::currentAndPast()->get();
		return View::make('activity.index' , array('f_activities'=>$f_activities ,'c_activities' => $cc_activities, 'now'=> $now));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /activity/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//

        return View::make('activity.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /activity
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $time = Input::get('time');
        $carbon_time = new Carbon($time);
        $month = $carbon_time->month;
        $year = $carbon_time->year;
        $str_year="";
        $str_semester="";
        if($month <= 5)
        {
            $str_year = ($year-1).'-'.$year;
            $str_semester = '2' ;
        }else if($month <= 7)
        {
            $str_year = ($year-1).'-'.$year;
            $str_semester = 'Hè' ;

        }
        else
        {
            $str_year = $year.'-'.($year+1);
            $str_semester = '1' ;
        }
        $id = Semester::year($str_year)->semester($str_semester)->get()->first()->id;
        UnionActivity::create( array_add(Input::all(),'semester_id' ,$id ));
        return Redirect::route('activity.index');
	}

	/**
	 * Display the specified resource.
	 * GET /activity/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        $activity = UnionActivity::find($id);
        $expired = $activity->time->gte(\Carbon\Carbon::now()) ;
        return View::make('activity.show', array('activity' => $activity ,  'expired'=> $expired));

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /activity/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $activity = UnionActivity::find($id);
        $html = View::make('activity.edit', array('activity'=>$activity))->render();
        return Response::json(array('html'=>$html));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /activity/{id}
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
	 * DELETE /activity/{id}
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
    public function attachMember()
    {
        $activity_id = Input::get('activity_id');
        $member_id = Input::get('member_id');
        $activity = UnionActivity::find($activity_id);
        $activity->youthMembers()->attach($member_id);
        return Response::json(array('msg'=>'success' ));
    }
    /**
     *
     */
    public function detachMember()
    {
        $activity_id = Input::get('activity_id');
        $member_id = Input::get('member_id');
        $activity = UnionActivity::find($activity_id);
        $activity->youthMembers()->detach($member_id);
        return Response::json(array('msg'=>'success' ));

    }
    /**
     *
     */
    public function schoolAttachMember()
    {
        $activity_id = Input::get('activity_id');
        $member_id = Input::get('member_id');
        $activity = SchoolActivity::find($activity_id);
        $activity->youthMembers()->attach($member_id);
        return Response::json(array('msg'=>'success' ));
    }
    /**
     *
     */
    public function schoolDetachMember()
    {
        $activity_id = Input::get('activity_id');
        $member_id = Input::get('member_id');
        $activity = SchoolActivity::find($activity_id);
        $activity->youthMembers()->detach($member_id);
        return Response::json(array('msg'=>'success' ));

    }
    /**
     *
     */
    public function attachAllMembers($id)
    {
        $activity = UnionActivity::find($id);
        $union = $activity->youthUnion;
        $list_id = $union->youthMembers()->joined()->get()->modelKeys();
        $activity->youthMembers()->sync($list_id , false);
        return Redirect::route('activity.show' ,array('activity'=>$id));

    }
    /**
     *
     */
    public function indexAdmin()
    {
        $table =   Datatable::table()
            ->addColumn('Hoạt Động', 'Địa Điểm'  ,'Chi Đoàn' ,'Năm Học' ,'Học Kỳ' ,'Chi Tiết',  'Duyệt' , 'Tình trạng' )
            ->setUrl( URL::route('get.all.activity'))
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 10 ,
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
        return View::make('activity.admin.index', array('table'=>$table));

    }
    /**
     *
     */
    public function getActivityDataTable()
    {
        return Datatable::collection(UnionActivity::with('semester' , 'youthUnion')->get())
            ->showColumns('name' , 'place' ,'union' , 'year' , 'semester','id' ,'confirm'  ,'time')

            ->addColumn('id', function($model){
                return '<a href="'.URL::route('data.show.activity' , array('id' =>$model->id)) .'" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-share-square-o"></i> </a>';
            })

            ->addColumn('confirm', function($model){
                if ($model->time->gte(\Carbon\Carbon::now())){
                return '<input type="checkbox"'.($model->confirm ? 'checked' : '' ) . ' class="check-multiple" data-aid="'.$model->id .'"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>'; }
                return 'Expired' ;
            })
            ->addColumn('semester' , function($model){
                return $model->semester->semester;
            })
            ->addColumn('year' , function($model){
                return $model->semester->year;
            })
            ->addColumn('union' , function($model){
                return $model->youthUnion->name;
            })
            ->addColumn('time' , function($model){
                return $model->time->diffForHumans();
            })
            ->searchColumns('union_id', 'name')
            ->orderColumns('name' ,'union_id')
            ->make();
    }
    public function confirmActivity()
    {
        $id = Input::get('activity_id');
        $activity = UnionActivity::find($id);
        $activity->confirm = true;
        $activity->save();
        return Response::json(array('msg' => 'success'));
    }
    /**
     *
     */
    public function delConfirmActivity()
    {
        $id = Input::get('activity_id');
        $activity = UnionActivity::find($id);
        $activity->confirm = false;
        $activity->save();
        return Response::json(array('msg' => 'success'));
    }
    /**
     *
     */
    public function getActivity($id)
    {
     $activity = UnionActivity::find($id);
     $html = View::make('activity.show-simple', array('activity'=>$activity))->render();
        return Response::json(array('html'=>$html));
    }
    /**
     *
     */
    public function indexSchool()
    {
        $activities = SchoolActivity::orderBy('expired_date', 'DESC')->get();
        $type = Input::has('type') ? Input::get('type') : 'default' ;
        if($type == 'member'){
            $activities = SchoolActivity::member()->orderBy('expired_date', 'DESC')->get();
        }else if($type == 'union'){
            $activities = SchoolActivity::union()->orderBy('expired_date', 'DESC')->get();
        }
         else{

         }

        if (Request::ajax())

        {

            $html = View::make('activity.partial.index-school' ,array('activities'=> $activities))->render();
            return Response::json( array('msg' => 'success' ,  'html'=> $html));
        }
        return View::make('activity.admin.index-school',array('activities' => $activities));
    }

    /**
     *
     */
    public function showSchool($id)
    {
        $activity = SchoolActivity::find($id);

        $members =   $activity->youthMembers()->with('youthUnion')->get();
        $unions = $activity->youthUnions()->get();
        return View::make('activity.admin.show' ,array('activity' => $activity , 'members' => $members , 'unions' => $unions));
    }
    /**
     *
    */
    public function createSchool()
    {

        return View::make('activity.admin.create-school');
    }
    /**
     *
     */
    public function storeSchool()
    {
        SchoolActivity::create(Input::all());
        return Redirect::route('admin.school.activity');
    }
    /**
     *
     */
    public function getAvailableSchool()
    {
        $member = Confide::user()->youthMember;

        $union =  $member->youthUnion ;
        $sign_activities = $union->schoolActivities()->lists('school_activity_id');
//        dd($sign_activities);
        $activities = SchoolActivity::available()->union()->get();

        $html = View::make('activity.admin.list_activity' , array('activities' => $activities , 'sign_activities' => $sign_activities))->render();
        return Response::json(array('html'=>$html));

    }
    /**
     *
     */
    public function attachUnion()
    {
        $activity_id = Input::get('activity_id');
        $member = Confide::user()->youthMember;

        $union =  $member->youthUnion ;
        $union->schoolActivities()->attach($activity_id);
        return Response::json(array('msg'=>'success'));

    }
    /**
     *
     */
    public function detachUnion()
    {
        $activity_id = Input::get('activity_id');
        $member = Confide::user()->youthMember;

        $union =  $member->youthUnion ;
        $union->schoolActivities()->detach($activity_id);
        return Response::json(array('msg'=>'success'));

    }
    /**
     *
     */
    public function getDataJoinMembers()
    {
        $id = Input::get('activity_id');

        $activity = SchoolActivity::find($id);
        $member = $activity->youthMembers()->with('youthUnion')->get();
        return Datatable::collection($member)
            ->showColumns('student_id' , 'name' ,'union_name' )

//            ->addColumn('name', function($model){
//                return '<a href="'.URL::route('data.show.activity' , array('id' =>$model->id)) .'" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-share-square-o"></i> </a>';
//            })

//            ->addColumn('confirm', function($model){
//                if ($model->time->gte(\Carbon\Carbon::now())){
//                    return '<input type="checkbox"'.($model->confirm ? 'checked' : '' ) . ' class="check-multiple" data-aid="'.$model->id .'"> <script type="text/javascript">
//         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
//</script>'; }
//                return 'Expired' ;
//            })
            ->addColumn('union_name' , function($model){
                return $model->youthUnion->name;
            })
            ->addColumn('name' ,function($model){
                return $model->first_name.' '.$model->last_name ;
            })

            ->searchColumns('student_id', 'union_name')
            ->orderColumns('name' ,'union_id')
            ->make();


    }
    /**
     *
     */
    public function getActivityOfMember()
    {
        $member_id = Input::get('member_id');
        $semester_id = Input::get('semester_id');
        $semester = Semester::find($semester_id);
//        dd($semester_id);
        $member = YouthMember::find($member_id);
        $school_activities = $member->schoolActivities()->semesterId($semester_id)->get();
        $union_activities = $member->unionActivities()->confirm()->semesterId($semester_id)->get();
        $html = View::make('activity.partial.activities-of-member' , array('semester' => $semester , 'member' => $member , 'school_activities' => $school_activities , 'union_activities' => $union_activities))->render();
        return Response::json(array('html' => $html));
     }
    /**
     *
     */
    public function getPartialActivityOfMember()
    {
        $type = Input::get('type');
        $member_id = Input::get('member_id');
        $semester_id = Input::get('semester_id');
        $semester = Semester::find($semester_id);
//        dd($semester_id);
        $member = YouthMember::find($member_id);
        if($type == 'school') {
            $activities = $member->schoolActivities()->semesterId($semester_id)->get();
        }else {
            $activities = $member->unionActivities()->confirm()->semesterId($semester_id)->get();
        }
        $html = View::make('activity.partial.partial-activities-of-member' , array('semester' => $semester , 'member' => $member , 'activities' => $activities ))->render();
        return Response::json(array('html' => $html));

    }


}