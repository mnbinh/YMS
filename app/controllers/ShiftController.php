<?php

class ShiftController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /shift
	 *
	 * @return Response
	 */
	public function index()
	{

        $n = Input::has('n') ? Input::get('n'): 1 ;
                $day = date('w');
        $member = Confide::user()->youthMember ;

        $week_start = date('Y-m-d', strtotime('+'.($n*7-$day+1).' days'));


        $week_end = date('Y-m-d', strtotime('+'.(6-$day+$n*7).' days'));
        $shifts = $member->shifts()->whereRaw('date <= ? and date >= ?' , array($week_end ,$week_start))->get();

        $tds = array();
      if($shifts->count())
      {
          foreach($shifts as $shift)
          {
              array_push($tds ,"td.".($shift->time).($shift->gate).($shift->date->toDateString()));
          }
      }
        if(Request::ajax())
        {
            if ($n == 0)
            {
                return Response::json(['flag' => false ,'msg' => 'Không thể đăng ký cho tuần hiện tại']);
            }
            if($n > 3)
            {
                return Response::json(['flag' => false ,'msg' => 'Không thể đăng ký cho qúa 3 tuần ']);

            }
            $html = View::make('shift.partial.table', array('day' => $day , 'n' => $n ) )->render();
            return Response::json(['flag' => true ,'msg' => 'success' , 'html' => $html ,'tds' =>$tds]);

        }

        return View::make('shift.index',array('day' => $day , 'n' => $n ,'tds' => $tds));

//        var_dump($day);
//        var_dump($week_end);
//        var_dump($week_start_0);
//        var_dump($week_start_1);
//        var_dump($test);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /shift/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /shift
	 *
	 * @return Response
	 */
	public function store()
	{
		$date =  Input::get('date');
        $gate = Input::get('gate');
        $time = Input::get('time');
        $yid = Confide::user()->youthMember->id ;
        $shift = Shift::firstOrCreate(array('date'=> $date , 'gate'=>$gate , 'time' =>$time));
        $shift->youthMembers()->attach($yid);
        if($shift->time == "1"){
            if($shift->gate == "1"){
                $message ="Bạn đã đăng ký trực thành công ở cổng 1 vào buối sáng ngày".$shift->date->toDateString();
            }
            else{
                $message ="Bạn đã đăng ký trực thành công ở cổng 2 vào buối sáng ngày".$shift->date->toDateString();

            }
        }else{
            if($shift->gate == "1"){
                $message ="Bạn đã đăng ký trực thành công ở cổng 1 vào buối chiều ngày".$shift->date->toDateString();

            }
            else{
                $message ="Bạn đã đăng ký trực thành công ở cổng 2 vào buối chiều ngày ".$shift->date->toDateString();

            }
        }

        return Response::json(array('message'=> $message));
	}
    /**
     *
     */
    public function restore()
    {
        $date =  Input::get('date');
        $gate = Input::get('gate');
        $time = Input::get('time');
        $yid = Confide::user()->youthMember->id ;
        $shift = Shift::firstOrCreate(array('date'=> $date , 'gate'=>$gate , 'time' =>$time));
        $shift->youthMembers()->detach($yid);
        $message ="Hũy đăng ký thành công" ;
        return Response::json(array('message'=> $message));
    }

	/**
	 * Display the specified resource.
	 * GET /shift/{id}
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
	 * GET /shift/{id}/edit
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
	 * PUT /shift/{id}
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
	 * DELETE /shift/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function fetch()
    {
        $start = Input::get('start');
        $end = Input::get('end');
        $events = array();
        $allShift = Shift::whereRaw('date > ? and date < ?',array($start ,$end))->get();
        foreach($allShift as $shift){

            $pos = $shift->date;
            $allEvent =  $shift->have_person()->get() ;
//            if($allEvent != null) {
                foreach($allEvent as $person){
                    $e = array();

                    $e['title'] = $person->first_name . ' ' . $person->last_name;
                    $e['start'] = date('Y-m-d', strtotime($shift->date));
                    $e['color'] = 'blue';
                    $e['allDay'] = true;
                    array_push($events, $e);
                }
//            }
        }


        return json_encode($events);
    }
    /**
     *
     */
    public function detail()
    {
        $uid = Input::get('uid');
        $member = YouthMember::find($uid);
        $shifts = $member->shifts()->where('date' ,'>' , date('Y-m-d'))->get();
        $html = View::make('shift.partial.detail',array('shifts'=> $shifts) )->render();
        return Response::json(['html' => $html]);

    }
    /**
     *
     */
    public function indexAdmin()
    {
        return View::make('shift.index-admin');
    }
    /**
     *
     */
    public function searchList()
    {

        $date =  Input::get('date');
        $gate = Input::get('gate');
        $time = Input::get('time');
        $shift = Shift::firstOrCreate(array('date'=> $date , 'gate'=>$gate , 'time' =>$time));
        $members = $shift->youthMembers()->with('youth_unions');
        $html = View::make('shift.partial.list', array('members'=> $members))->render();
        return Response::json(['html' => $html]);

    }

}