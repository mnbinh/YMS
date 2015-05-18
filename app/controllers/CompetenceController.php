<?php

class CompetenceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /competence
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $unions = YouthUnion::active()->get();
        $union_id = Input::has('union_id') ?Input::get('union_id') :$unions->first()->id ;
        $year =Helpers::findSemester()['year'];
        $prorogue = Prorogue::where('name', '=' , $year)->first();
        $prorogues = Prorogue::all();
        $table =   Datatable::table()

            ->addColumn('Mã Đoàn Viên', 'Họ Tên'  ,'Đối Tượng' ,'Mã Chi Đoàn' ,'Tên Chi Đoàn' ,'Mã Chức Vụ', 'Tên Chức Vụ',  'Nhiệm Kỳ' , 'Ngày Bắt Đầu' , 'Ngày Kết Thúc' )
            ->setUrl( URL::route('admin.data.competence', array('union_id'=>$union_id, 'prorogue_id' => $prorogue->id)))
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
        return View::make('competence.index' , array('table' => $table , 'unions' => $unions , 'prorogues' => $prorogues , 'prorogue' => $prorogue ,'union_id'=> $union_id));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /competence/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $prorogue_id = Input::get('prorogue_id');
        $prorogue = Prorogue::find($prorogue_id);
        if(!($prorogue->end->gte(\Carbon\Carbon::now())))
        {
            return Response::json(array('avail' => false , 'msg' => 'success'));
        }
        $unions = YouthUnion::active()->lists('name', 'id');
        $type = TypeCompetence::name('class_union')->first();
        $competences = $type->competences()->lists('name' ,'id');

        $html = View::make('competence.create', array('unions'=>$unions, 'competences'=>$competences,'prorogue'=>$prorogue))->render();
        return Response::json(array('html'=> $html, 'avail' => true , 'msg' => 'success'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /competence
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $student_id = Input::get('student_id');
        $competence_id = Input::get('competence_id');
        $prorogue_id = input::get('prorogue_id');
        $member = YouthMember::where('student_id','=' , $student_id)->firstOrFail();
        $member->competences()->attach($competence_id, array('prorogue_id' => $prorogue_id));
        return Redirect::route('competence.index');
	}

	/**
	 * Display the specified resource.
	 * GET /competence/{id}
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
	 * GET /competence/{id}/edit
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
	 * PUT /competence/{id}
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
	 * DELETE /competence/{id}
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
    public function getDataCompetence()
    {
        $union_id = Input::get('union_id');
        $prorogue_id = Input::get('prorogue_id');
        $competence_detail = CompetenceDetail::union($union_id)->prorogueId($prorogue_id)->with('competence','prorogue' , 'youthMemberWithFull')->get();
        return Datatable::collection($competence_detail)
            ->showColumns('student_id' , 'name' ,'type_name' , 'union_code' , 'union_name','competence_code'
                ,'competence_name'  ,'prorogue_name' , 'prorogue_start' , 'prorogue_end')

            ->addColumn('student_id', function($model){
                return $model->youthMemberWithFull->student_id;
            })

            ->addColumn('name', function($model){

                return $model->youthMemberWithFull->first_name.' '.$model->youthMemberWithFull->last_name;
            })
            ->addColumn('type_name' , function($model){
                return $model->youthMemberWithFull->type_name;
            })
            ->addColumn('union_code' , function($model){
                return $model->youthMemberWithFull->union_code;
            })
            ->addColumn('union_name' , function($model){
                return $model->youthMemberWithFull->union_name;
            })
            ->addColumn('competence_code' , function($model){
                return $model->competence->code;
            })
            ->addColumn('competence_name' , function($model){
                return $model->competence->name;
            })
            ->addColumn('prorogue_name' , function($model){
                return $model->prorogue->name;
            })
            ->addColumn('prorogue_end' , function($model){
                return $model->prorogue->end->toDateString();
            })
            ->addColumn('prorogue_start' , function($model){
                return $model->prorogue->start->toDateString();
            })
            ->searchColumns('name' , 'student_id')
            ->orderColumns('name' )
            ->make();
    }
    /**
     *
     */
    public function getDataMember()
    {


        $term = Input::get('term');
        $uid= '';
        if(Input::has('union_id')){
            $uid = Input::get('union_id');
        }
        else {
            $uid = Confide::user()->youthMember->youth_union_id;
        }
        $union = YouthUnion::find($uid);
        $results = $union->youthMembers()->with('youthUnion')->like('student_id', $term)->get();
        $res = array();
        foreach($results as $re){
            array_push($res , array('value'=>$re->student_id  ,'union' => "Chi Đoàn: ".$re->youthUnion->name, 'label' =>$re->first_name.' '.$re->last_name));

        }
        return Response::json($res ,200, array(), JSON_UNESCAPED_UNICODE );


    }

}