<?php

class FeeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /fee
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $member = Confide::user()->youthMember;

        $union =  $member->youthUnion ;
        $years = YearFee::all();
        $year = '2013';
        if(Input::has('year'))
        {
            $year = Input::get('year');

        }
        $id = YearFee::where('year','=' , $year)->get()->first()->id;
        $table =   Datatable::table()
            ->addColumn('MSSV', 'Họ Tên'  ,'T1 ' ,'T2 ' , 'T3 ' , 'T4 ' ,'T5 ' , 'T6 ' ,'T7 ' ,'T8 ' , 'T9 ' ,'T10 ' ,'T11' , 'T12'  )
            ->setUrl( URL::route('union.data.fee',array('year_id' =>$id )))
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 10 ,
                "bPaginate" => true,
                "bProcessing"=> true ,
                "oLanguage" => array(
                    "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

     "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'
                ) ,
                "columnDefs" => [array('width' => "5%" ,"targets" => [2,3,4,5,6,7,8,9,10,11,12,13])],
                "bLengthChange"=> true,
                "dom"=> '<"toolbar">frtip',
                "bFilter"=> true,
                "bSort"=> true,
                "bInfo"=> true,
                "bAutoWidth"=> false))
            ->noScript();
        return View::make('fee.index' , array('table' => $table ,'years'=>$years));
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /fee/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $year = YearFee::lists('year' ,'id' );
        $types = TypeFee::all();
        $html = View::make('fee.admin.create' , array('year' => $year ,'types'=> $types))->render();
        return Response::json(array('html'=> $html));


    }

	/**
	 * Store a newly created resource in storage.
	 * POST /fee
	 *
	 * @return Response
	 */
	public function store()
	{
		//

        $year_id = Input::get('year_id');
        $types = TypeFee::all();
        foreach($types as $type){
            $id = $type->id;
            $fee = Input::get($id);
                MonthFee::insert(array(

                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '1'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '2'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '3'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '4'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '5'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '6'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '7'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '8'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '9'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '10'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '11'),
                    array('year_id' => $year_id, 'type_id' => $id, 'fee' => $fee, 'month' => '12'),
                ));

        }
        return Redirect::route('admin.fee.index');







    }

	/**
	 * Display the specified resource.
	 * GET /fee/{id}
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
	 * GET /fee/{id}/edit
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
	 * PUT /fee/{id}
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
	 * DELETE /fee/{id}
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
    public function indexAdmin()
    {
        $years = YearFee::all();
        $year = '2013';
        if(Input::has('year'))
        {
            $year = Input::get('year');

        }
        $id = YearFee::where('year','=' , $year)->get()->first()->id;
        $table =   Datatable::table()
            ->addColumn('Năm Đóng Đoàn Phí', 'Số Tiền /Tháng (VNĐ)'  ,'Đối Tượng Đóng' ,'Chỉnh Sửa' )
            ->setUrl( URL::route('admin.data.fee',array('id' =>$id)))
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
        return View::make('fee.admin.index', array('table'=>$table , 'years' => $years));

    }
    /**
     *
     */
    public function getDataMonthFee()
    {
        $year = YearFee::find(Input::get('id'));
        return Datatable::collection($year->monthFees()->groupByTypeFee('type_id')->with('typeFee')->get())
            ->showColumns('year' , 'fee' ,'type_id' , 'year','id' )

            ->addColumn('id', function($model){
                return '<a href="'.URL::route('data.show.activity' , array('id' =>$model->id)) .'" class="detail btn btn-flat btn-info btn-xs" ><i class="fa fa-share-square-o"></i> </a>';
            })
            ->addColumn('year', function($model) use ($year){
                return $year->year;
            })


            ->addColumn('type_id', function($model){
                return $model->typeFee->name ;
            })
            ->searchColumns('year', 'fee')
            ->orderColumns('year' ,'fee')
            ->make();

    }


    public function getDataStudentFee()
    {
        $member = Confide::user()->youthMember;
        $union =  $member->youthUnion ;
        $year_id = Input::get('year_id');
        $year = YearFee::find($year_id);
        $member_with_fee = YouthMember::never()->get();
        if($year->monthFees->count()) {

            $member_with_fee = $union->youthMembers()->with(array('monthFees' => function ($query) use ($year_id) {
                $query->where('year_id', '=', $year_id);
            }))->get();
        }

        return Datatable::collection($member_with_fee)
            ->showColumns('student_id' ,'name' , 'T1' ,'T2' , 'T3','T4' , 'T5' , 'T6' , 'T7','T8' ,'T9' ,'T10' ,'T11' ,'T12' )

            ->addColumn('name', function($model){
                return $model->first_name .' '.$model->last_name ;
            })
            ->addColumn('T1', function($model) use ($year_id){
             return  '<input type="checkbox" '.(in_array('1' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                  $model->id. '"data-yid="'.$year_id .'" data-month="1">' ;


            })
            ->addColumn('T2', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('2' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="2">' ;

            })
            ->addColumn('T3', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('3' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="3">' ;

            })
            ->addColumn('T4', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('4' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="4">' ;

            })
            ->addColumn('T5', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('5' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="5">' ;

            })
            ->addColumn('T6', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('6' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="6">' ;

            })
            ->addColumn('T7', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('7' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="7">' ;

            })
            ->addColumn('T8', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('8' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="8">' ;

            })
            ->addColumn('T9', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('9' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="9">' ;

            })
            ->addColumn('T10', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('10' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="10">' ;

            })
            ->addColumn('T11', function($model) use ($year_id){
                return   '<input type="checkbox" '. (in_array('11' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="11">' ;

            })
            ->addColumn('T12', function($model) use ($year_id){
                return   '<input type="checkbox" '.(in_array('12' , $model->monthFees->lists('month')) ? "checked" : "").' class="check-multiple" data-id="'.
                    $model->id. '"data-yid="'.$year_id .'" data-month="12">' ;

            })

            ->searchColumns('name')
            ->orderColumns('name')
            ->make();

    }
    /**
     *
     */
    public function payFee()
    {
        $member = Confide::user()->youthMember;
        $type_id =  $member->type_id ;
        $member_id = Input::get('id');
        $year_id = Input::get('yid');
        $month = Input::get('month');
        $month_fee = MonthFee::where('year_id' , $year_id)->where('type_id' ,$type_id)->where('month' , $month)->firstOrFail();
        $month_fee->youthMembers()->attach($member_id);
        return Response::json(array('msg' => 'success'));

    }
    /**
     *
     */
    public function rePayFee()
    {
        $member = Confide::user()->youthMember;
        $type_id =  $member->type_id ;
        $member_id = Input::get('id');
        $year_id = Input::get('yid');
        $month = Input::get('month');
        $month_fee = MonthFee::where('year_id' , $year_id)->where('type_id' ,$type_id)->where('month' , $month)->firstOrFail();
        $month_fee->youthMembers()->detach($member_id);
        return Response::json(array('msg' => 'success' ));


    }
    public function manageFee()
    {
        $years = YearFee::all();
        $day = new \Carbon\Carbon();
        $year = $day->year;
        if(Input::has('year'))
        {
            $year = Input::get('year');

        }
        $id = YearFee::where('year','=' , strval($year))->get()->first()->id;
        $table =   Datatable::table()
            ->addColumn('Mã Chi Đoàn', 'Tên Chi Đoàn'  ,'Số lượng' , 'T1 ' ,'T2 ' , 'T3 ' , 'T4 ' ,'T5 ' , 'T6 ' ,'T7 ' ,'T8 ' , 'T9 ' ,'T10 ' ,'T11' , 'T12' )
            ->setUrl( URL::route('admin.data.union.fee',array('year_id' =>$id)))
            ->setOptions(array('bPaginate'=> true ,
                'sPaginationType'=>'full_numbers',
                'iDisplayLength' => 10 ,
                "bPaginate" => true,
                "bProcessing"=> true ,
                "oLanguage" => array(
                    "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

     "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'
                ) ,
                "columnDefs" => [array('width' => "5%" ,"targets" => [3,4,5,6,7,8,9,10,11,12,13 ,14])],
                "bLengthChange"=> true,
                "dom"=> '<"toolbar">frtip',
                "bFilter"=> true,
                "bSort"=> true,
                "bInfo"=> true,
                "bAutoWidth"=> false))
            ->noScript();
        return View::make('fee.admin.union-fee' ,array('table' => $table ,  'years' => $years , 'year_id' => $id));
    }
    public function getDataUnionFee()
    {

        $year_id = Input::get('year_id');
        $year = YearFee::find($year_id);
        $union_with_fee = YouthMember::never()->get();
        if($year->monthFees->count()) {


            $union_with_fee = YouthUnion::with(['pays' => function($query)use ($year_id) {
                $query->check()->payType('YouthMember')->with(['monthFee' => function($q2)use($year_id){
                    $q2->year($year_id);}]);} , 'youthMembers'])->get();
        }

        return Datatable::collection($union_with_fee)
            ->showColumns('union_id' ,'name' ,'count', 'T1' ,'T2' , 'T3','T4' , 'T5' , 'T6' , 'T7','T8' ,'T9' ,'T10' ,'T11' ,'T12' )
            ->addColumn('count', function($model){
                return $model->youthMembers->count();
            })
            ->addColumn('T1', function($model) {

                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "1") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return '<span class="'.$model->union_id.' 1">' .number_format($sum) .'</span>';


            })
            ->addColumn('T2', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "2") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 2">' .number_format($sum) .'</span>';
            })
            ->addColumn('T3', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "3") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 3">' .number_format($sum) .'</span>';

            })
            ->addColumn('T4', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "4") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 4">' .number_format($sum) .'</span>';

            })
            ->addColumn('T5', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "5") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 5">' .number_format($sum) .'</span>';

            })
            ->addColumn('T6', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "6") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 6">' .number_format($sum) .'</span>';

            })
            ->addColumn('T7', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "7") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 7">' .number_format($sum) .'</span>';

            })
            ->addColumn('T8', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "8") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 8">' .number_format($sum) .'</span>';

            })
            ->addColumn('T9', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "9") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 9">' .number_format($sum) .'</span>';

            })
            ->addColumn('T10', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "10") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 10">' .number_format($sum) .'</span>';

            })
            ->addColumn('T11', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "11") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 11">' .number_format($sum) .'</span>';

            })
            ->addColumn('T12', function($model) use ($year_id){
                $sum = 0;
                foreach($model->pays as $pay)
                {
                    if(isset($pay->monthFee ) && $pay->monthFee->month == "12") {

                        $sum = $sum + $pay->monthFee->fee;
                    }

                }
                return  '<span class="'.$model->union_id.' 12">' .number_format($sum) .'</span>';

            })

            ->searchColumns('name')
            ->orderColumns('name')
            ->make();

    }
    /**
     *
     */
    public function allowPay()
    {
        $union = null;
        $year_id = Input::get('year_id');
        if(Input::has('union_id')){
            $union = YouthUnion::find(Input::get('union_id'));
        }else{
            $union = YouthUnion::active()->first();
        }
        $monthFees = MonthFee::year($year_id)->typeFee($union->youthMembers()->firstOrFail()->type_id)->lists('fee' ,'month' );


        $unions = YouthUnion::active()->lists('name' ,'id' );
        $count = $union->youthMembers()->count();
        $pays = $union->pays()->with(['monthFee' => function($query) use ($year_id){
            $query->year($year_id);
        }])->get();


        $html = View::make('fee.admin.allow-pay' , array('uid'=> $union->id,'yid' =>$year_id,'monthFees' => $monthFees ,'count' => $count ,'unions' => $unions ,'pays' => $pays))->render();
        return Response::json(array('html'=> $html));
    }
    /**
     *
     */
    public function allowPayChangeUnion()
    {

        $year_id = Input::get('year_id');
        $union = YouthUnion::find(Input::get('union_id'));

        $monthFees = MonthFee::year($year_id)->typeFee($union->youthMembers()->firstOrFail()->type_id)->lists('fee' ,'month' );


        $count = $union->youthMembers()->count();
        $pays = $union->pays()->with(['monthFee' => function($query) use ($year_id){
            $query->year($year_id);
        }])->get();


        $html = View::make('fee.partial.table',array( 'pays' => $pays , 'uid' => $union->id ,'yid' => $year_id ,'count' => $count , 'monthFees' =>$monthFees))->render();
        return Response::json(array('html'=> $html));

    }
    /**
     *
     */
    public function checkUnionPay()
    {
        $month = Input::get('month');
        $year_id = Input::get('year_id');
        $union = YouthUnion::find(Input::get('union_id'));
        $pays = $union->pays()->with(['monthFee' => function($query) use ($year_id){
            $query->year($year_id);
        }])->get();
        $array_id = array();
        $total = 0;
        foreach($pays as $pay)
        {
            if(isset($pay->monthFee) && $pay->monthFee->month== $month )
            {
                array_push($array_id , $pay->id);
                $total = $total + $pay->monthFee->fee ;
            }
        }
        DB::table('pays')->whereIn('id' , $array_id)->update(array('check' => true));
        $jquery = 'span.'.$union->union_id.'.'.$month ;
        return Response::json(array('msg' =>'success' ,'jquery' => $jquery , 'total' => $total));
    }
    public function recheckUnionPay()
    {
        $month = Input::get('month');
        $year_id = Input::get('year_id');
        $union = YouthUnion::find(Input::get('union_id'));
        $pays = $union->pays()->with(['monthFee' => function($query) use ($year_id){
            $query->year($year_id);
        }])->get();
        $array_id = array();
        foreach($pays as $pay)
        {
            if(isset($pay->monthFee) && $pay->monthFee->month== $month )
            {
                array_push($array_id , $pay->id);
            }
        }
        DB::table('pays')->whereIn('id' , $array_id)->update(array('check' => false));
        $jquery = 'span.'.$union->union_id.'.'.$month ;
        return Response::json(array('msg' =>'success' ,'jquery' => $jquery , 'total' => 0));
    }
}