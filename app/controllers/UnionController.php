<?php

class UnionController extends \BaseController {
//   protected $import;
	/**
	 * Display a listing of the resource.
	 * GET /union
	 *
	 * @return Response
	 */
//    function __construct(Hi $_import)
//    {
//        $this->import = $_import;
//         TODO: Implement __construct() method.
//    }

    public function index()
	{

      $table =   Datatable::table()
            ->addColumn('Mã Chi Đoàn', 'Tên Chi Đoàn'  ,'Bí Thư'  ,'Số Lượng thành viên' ,'Tình trạng' ,'Chi tiết ','Sũa', 'Chọn' )
            ->setUrl( URL::route('data.members'))
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

        return View::make('union.index' , array('table' => $table) );
	}
    /**
     * Return the data for datatable
     * GET /members
     *
     * @return Response
     */
 public function getMembersDataTable()
 {

   $year = Helpers::findSemester()['year'];
     return Datatable::collection(YouthUnion::with(array('competencesWithMember' => function ($query) use ($year) {
         $query->where('prorogues.name', '=', $year)->where('competences.code','=','CD-BT');
     } ,'secretaries','youthMembers'))->get())
       ->showColumns('union_id','name' , 'secretary' ,'count' ,'active','member' ,'id' ,'check')

         ->addColumn('id', function($model){
             return '<a href="/union/' . $model->id .'/edit" class="edit btn btn-xs btn-flat btn-info" ><i class="fa fa-edit"></i> </a>';
         })
         ->addColumn('count', function($model){
             return $model->youthMembers->count();
         })
         ->addColumn('active', function($model){
             if($model->active)
             { return "Hoạt Động" ;}
             return "Ngưng" ;
         })
         ->addColumn('member', function($model){
             return '<a href="'.URL::route('members.index', array('union_id' => $model->id)).'" class="detail btn btn-xs btn-flat btn-success" ><i class="fa fa-group"></i> </a>';
         })
         ->addColumn('secretary' , function($model){
             if($model->competencesWithMember->count()){

             return $model->competencesWithMember->first()->first_name.' '.$model->competencesWithMember->first()->last_name;}
             return '<a href="' .URL::route('competence.index', array('union_id'=> $model->id)).'" class=" btn-link" >Cập nhật </a>';
         })

         ->addColumn('check', function($model){
                return '<input type="checkbox" class="check-multiple" data-id="'.$model->id .'"> <script type="text/javascript">
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"})
</script>';
         })
//         ->addColumn('secretary' , function($model){
//             if($model->secretaries->count() >0){
//                     $sec =  $model->secretaries->first();
//                 return $sec->first_name.' '.$sec->last_name ;
//             }else{
//                 return link_to_route('set.secretary' , 'Chọn Bí Thư' , array('id' => $model->id) , array('class'=> 'secretary'));
//             }
//            })
         ->searchColumns('union_id', 'name')
         ->orderColumns('name' ,'union_id')
         ->make();
 }

	/**
	 * Show the form for creating a new resource.
	 * GET /union/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $html = View::make('union.new')->render();
        return Response::json(array('html'=>$html));

	}
    /**
     * Show the form for creating a new resource.
     * GET /union/import
     *
     * @return Response
     */
    public function import()
    {
        $html = View::make('union.import')->render();
        return Response::json(array('html'=>$html));
    }
    public function exportUnion()
    {
        $data = YouthUnion::all()->toArray();
//        $data = DB::table('youth_unions')->select('name' , 'active' )->get();
        Excel::create('Text', function($excel) use($data) {


            $excel->sheet('Export', function($sheet) use($data) {

                $sheet->fromArray($data);

            });

        })->export('xls');
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /union
	 *
	 * @return Response
	 */
	public function store()
	{
//		$file = Input::file('excel');
//        $name = $file->getClientOriginalName();
////        $extension = $file->getClientOriginalExtension();
//        $file->move('Shin',$name);
//        return 'Done';
//        $results = $this->import->get();
//        File::delete( $this->import->test);
//        dd($results);
        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $name = Input::get( 'name' );
        $union_id = Input::get( 'union_id' );
        YouthUnion::create(array('name'=>$name , 'union_id' => $union_id));
        //.....
        //validate data
        //and then store it in DB
        //.....

        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );

        return Response::json( $response );


    }

	/**
	 * Display the specified resource.
	 * GET /union/{id}
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
	 * GET /union/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$union = YouthUnion::findOrFail($id);
        $html = View::make('union.edit', array('union'=> $union))->render();
        return Response::json(array('html'=>$html));
	}
    public function setSecretary($id)
    {
        $html = View::make('union.secretary', array('id'=> $id))->render();
        return Response::json(array('html'=>$html));
    }
    public function storeSecretary($id)
    {
        $sid = Input::get('student_id');
        $member = YouthMember::where('student_id', '=', $sid)->firstOrFail();

        $union = YouthUnion::findOrFail($id);
        $union->secretaries()->attach($member);
        $response = array(
            'status' => 'success',
            'msg' => 'Setting secretary successfully',
            'secreatary' => $member->first_name.' '.$member->last_name
        );

        return Response::json( $response );

    }

	/**
	 * Update the specified resource in storage.
	 * PUT /union/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $union = YouthUnion::findOrFail($id);
        $union->update(Input::all());
        $response = array(
            'status' => 'success',
            'msg' => 'Setting edit successfully'
        );

        return Response::json( $response );
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /union/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function destroyMultiple()
    {
      if(YouthUnion::destroy(Input::get('id')) > 0) {
          $response = array(
              'status' => 'success',
              'msg' => 'Setting delete successfully',
          );

          return Response::json( $response );
      }
        $response = array(
            'status' => 'fail',
            'msg' => 'Something wrong ',
        );

        return Response::json( $response );
    }



}