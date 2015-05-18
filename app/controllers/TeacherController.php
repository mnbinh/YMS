<?php

class TeacherController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /teacher
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $table =   Datatable::table()
            ->addColumn( 'Mã Cán Bộ', 'Họ Tên'  ,'Ngày Sinh' ,'Email' ,'Chi Tiết' , 'Sữa' , 'Chọn' )
            ->setUrl( URL::route('teacher.data'))
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
        return View::make('teacher.index' , array('table'=> $table));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /teacher/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /teacher
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        Teacher::create(Input::all());
        return Response::json(array('msg' =>'success'));
	}

	/**
	 * Display the specified resource.
	 * GET /teacher/{id}
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
	 * GET /teacher/{id}/edit
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
	 * PUT /teacher/{id}
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
	 * DELETE /teacher/{id}
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
    public function getDataTable()
    {
        $teacher = Teacher::all();
        return Datatable::collection($teacher)
            ->showColumns('teacher_id' ,  'name'  , 'bird_date','email' , 'view' ,'edit','check'   )

            ->addColumn('view', function($model){

                return '<a href="' . URL::route('teacher.show', array('id' => $model->id)) . '" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-share-square-o"></i> </a>';

            })
            ->addColumn('edit', function($model){

                return '<a href="' . URL::route('teacher.edit', array('id' => $model->id)) . '" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-edit"></i> </a>';

            })

            ->addColumn('name' , function($model){

                    return $model->first_name.' '.$model->last_name;

            })

            ->addColumn('check' , function($model){
                return '<input type="checkbox" class="check-multiple" data-id="'.$model->id .'"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>';
            })
            ->addColumn('bird_date' , function($model){

                return $model->bird_date->toDateString();;
            })

            ->searchColumns('email', 'name' )
            ->orderColumns('union' ,'email', 'name')
            ->make();
    }
    /**
     *
     */
    public function checkEmail()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'email' => 'unique:teachers'
            )
        );
        if ($validator->fails())
        {
            return 'false' ;
        }
        return 'true';
    }

    /**
     * @return string
     */
    public function checkId()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'teacher_id' => 'unique:teachers'
            )
        );
        if ($validator->fails())
        {
            return 'false' ;
        }
        return 'true';
    }

}