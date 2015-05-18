<?php
use ExcelImport as Import ;
class ImportController extends \BaseController {

   protected $import;
    /**
     * Display a listing of the resource.
     * GET /union
     *
     * @return Response
     */
    function __construct(Import $_import)
    {
        $this->import = $_import;
//         TODO: Implement __construct() method.
    }
	/**
	 * Display a listing of the resource.
	 * GET /import
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /import/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /import
	 *
	 * @return Response
	 */
	public function storeUnion()
	{   $results = $this->import->get();
        File::delete( $this->import->test);
        $first_sheet = $results->first();

        $first_sheet->each(function($row){
//            dd($row);
           YouthUnion::create(array('union_id' => $row->ma_chi_doan , 'name' => $row->ten_chi_doan));
        });
       return Redirect::route('union.index');
	}
    /**
     *
     */
    public function storeMember()
    {
        $union_id = Input::get('union_id');
        $results = $this->import->get();
        File::delete( $this->import->test);
        $first_sheet = $results->first();

        $first_sheet->each(function($row) use ($union_id){

            YouthMember::create(array(
                'youth_union_id' => YouthUnion::unionId($row->ma_chi_doan)->firstOrFail()->id ,
                'first_name' => $row->ho ,
                'last_name' =>$row->ten,
                'date_of_bird' =>$row->ngay_sinh,
                'join_date' =>$row->ngay_vao_doan ,
                'student_id'=> $row->ma_doan_vien ,
                'email' => $row->email ,
                'gender' => $row->gioi_tinh ,

            ));
        });
        return Response::json(['msg' => 'success']);

    }


	/**
	 * Display the specified resource.
	 * GET /import/{id}
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
	 * GET /import/{id}/edit
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
	 * PUT /import/{id}
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
	 * DELETE /import/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}