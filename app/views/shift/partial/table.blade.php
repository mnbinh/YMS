<div class="box-header">
<h3 class="box-title">Đăng ký Trực từ ngày {{date('d-m-Y', strtotime('+'.(6-$day+$n*7 -5).' days'))}} đến ngày {{date('d-m-Y', strtotime('+'.(6-$day+$n*7).' days'))}}</h3>

</div>
<div class="box-body ">
<div class="btn-group" style="margin-bottom: 10px">
        <a class="active btn btn-warning btn-flat change " href="{{URL::route('shifts.index', array('n' =>$n-1))}}"><i class="fa fa-chevron-left"></i></a>
        <a class="btn btn-warning btn-flat change" href="{{URL::route('shifts.index', array('n' =>$n+1))}}"><i class="fa fa-chevron-right"></i></a>

 </div>
 <a class="btn btn-flat btn-info pull-right detail" href="{{URL::route('shifts.detail' ,array('uid' => Confide::user()->youthMember->id))}}">Lịch Trực</a>
<table class="table table-bordered">
    <tbody><tr>
        <th rowspan="2" style="width: 10px">#</th>
        <th colspan="2">Thứ 2</th>
        <th colspan="2">Thứ 3</th>
        <th colspan="2">Thứ 4</th>
        <th colspan="2">Thứ 5</th>
        <th colspan="2">Thứ 6</th>
        <th colspan="2">Thứ 7</th>
    </tr>
    <tr>

            <th>Cổng 1</th>
            <th>Cổng 2</th>
            <th>Cổng 1</th>
            <th>Cổng 2</th>
            <th>Cổng 1</th>
            <th>Cổng 2</th>
            <th>Cổng 1</th>
            <th>Cổng 2</th>
            <th>Cổng 1</th>
            <th>Cổng 2</th>
            <th>Cổng 1</th>
            <th>Cổng 2</th>
    </tr>
    <tr>
        <th>Sáng</th>
        <td class="11{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="1"
        data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}"><i class="fa fa-users"></i> </a></td>

       <td class="12{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}"><i class="fa fa-users"></i> </a></td>

        <td class="11{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="12{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="11{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="12{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

        <td class="11{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="12{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}"><i class="fa fa-users"></i> </a></td>

        <td class="11{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

        <td class="12{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

        <td class="11{{date('Y-m-d', strtotime('+'.(6-$day+$n*7).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 ).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="12{{date('Y-m-d', strtotime('+'.(6-$day+$n*7).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="1" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 ).' days'))}}"><i class="fa  fa-users"></i> </a></td>
    </tr>
    <tr>
       <th>Chiều</th>
       <td class="21{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="1"
        data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="22{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -5).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="21{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}"><i class="fa  fa-users"></i> </a></td>

        <td class="22{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -4).' days'))}}"><i class="fa  fa-users"></i> </a></td>

       <td class="21{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

        <td class="22{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -3).' days'))}}"><i class="fa fa-users"></i> </a></td>

        <td class="21{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}"><i class="fa fa-users"></i> </a></td>

       <td class="22{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -2).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

       <td class="21{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}"><i class="fa fa-users"></i>  </a></td>

       <td class="22{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 -1).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

      <td class="21{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 ).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="1"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 ).' days'))}}"><i class="fa  fa-users"></i>  </a></td>

        <td class="22{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 ).' days'))}}">
        <a class="btn btn-flat btn-info btn-xs" data-time="2" data-gate="2"
                    data-date="{{date('Y-m-d', strtotime('+'.(6-$day+$n*7 ).' days'))}}"><i class="fa  fa-users"></i>  </a></td>
    </tr>

</tbody></table>
</div>