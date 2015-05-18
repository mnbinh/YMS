@extends('layout.master')

@section('styles')
         {{ HTML::style('css/iCheck/minimal/red.css') }}
                  {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}
              {{--<link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">--}}
              {{--<script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>--}}
              {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
              <style type="text/css">
              table th {text-align: center;}
              </style>

   {{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                         {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
   {{--<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>--}}
   {{HTML::script('js/net/moment.js')}}
   {{--<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>--}}
    {{HTML::script('js/net/daterangepicker.js')}}
   {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />--}}
    {{ HTML::style('css/net/daterangepicker.css') }}
   {{--Datatable--}}
            {{--<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>--}}
                 {{HTML::script('js/net/datatable-min.1.10.5.js')}}
              {{--<script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>--}}
                 {{HTML::script('js/net/datatable.bootstrap.js')}}
                  <style type="text/css">
                  .box {border-radius: 0px;
                        -webkit-border-radius: 0px;   }
                  .control-label {
                    padding-top: 7px;
                    margin-bottom: 0;
                    text-align: right;
                  }
                  </style>
                                        <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Hoạt Động Chi Đoàn

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">
<div row>
<div class="col-lg-7">
 <div class="box box-info">
                                <div class="box-header" >
                                    <h3 class="box-title">{{$activity->name}}</h3>
                                   <div class="box-tools pull-right">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn btn-flat btn-info btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
                                                Cập nhật <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li role="presentation">

                                                <a role="menuitem" tabindex="-1" href="{{URL::route('activity.edit' , array('activity'=>$activity->id))}}" class="edit" >Chỉnh sữa thông tin</a>
                                                </li>

                                                <li role="presentation">
                                     <a role="menuitem" tabindex="-1" href=" {{$activity->is_union ? "#" :URL::route('search.member'  ,array('activity_id' => $activity->id))}}" class="edit_member" >Cập nhật danh sách Tham gia</a>

                                                </li>

                                            </ul>
                                        </div>

                                  {{--<button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-6">
                                      <dl class="dl-horizontal">
                                        <dt class="text-muted"><b>Đối Tượng:</b></dt>
                                        @if($activity->is_union)
                                        <dd><div class="label bg-green">
                                        Chi Đoàn

                                        </div></dd>
                                        @else
                                        <dd><div class="label bg-red">
                                        Đoàn Viên

                                        </div></dd>
                                        @endif
                                      </dl>
                                      </div>
                                    </div>
                                       <div class="row" style="margin-bottom: 10px">
                                         <div class="col-md-6">
                                               <dl class="dl-horizontal">
                                             <dt class="text-muted"><b>Thời gian:</b></dt>
                                              <dd>{{$activity->date->toDateString()}}</dd>
                                             <dt class="text-muted"><b>Địa Điểm:</b></dt>
                                              <dd>Cần Thơ</dd>
                                            </dl>
                                         </div>
                                         <div class="col-md-6">
                                               <dl class="dl-horizontal">
                                             <dt class="text-muted"><b>Ngày tạo:</b></dt>
                                              <dd>{{$activity->created_at->toDateString()}}</dd>
                                    <dt class="text-muted"><b>Học Kỳ:</b></dt>
                                              <dd>{{'Học kỳ ' .$activity->semester->semester .'/'.$activity->semester->year  }}</dd>
                                                 </dl>


                                                 </dl>
                                         </div>



                                       </div>
                                      <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-12">
                                      <dl class="dl-horizontal">
                                      <dt class="text-muted"><b>Chi Tiết:</b></dt>
                                      <dd>{{$activity->description}}</dd>
                                      </dl>
                                      </div>
                                    </div>
                            </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
</div>
<div class="col-lg-5">
<div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Danh Sách</h3>
                                </div><!-- /.box-header -->
                               <div class="box-body table-responsive">
                                    {{--<div class="callout callout-danger">--}}
                                        {{--<h4>I am a danger callout!</h4>--}}
                                        {{--<p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>--}}
                                    {{--</div>--}}
                                      {{--{{ $table->render() }}--}}
                                      {{--{{ $table->script() }}--}}
   @if( $activity->is_union)
 <table id="list_member" class="table table-bordered">

     <thead>
     <tr>
                 <th align="center" valign="middle" class="head1">Mã Chi Đoàn</th>
                 <th align="center" valign="middle" class="head2">Chi Đoàn</th>
                 <th align="center" valign="middle" class="head8">Vắng</th>
             </tr>
     </thead>
     <tbody>
     @foreach($unions as $union)
                 <tr>
                     <td align="center" valign="middle" class="head1">{{ $union->union_id }}</td>
                     <td align="left" valign="middle" class="head2">{{$union->name}}</td>
                     <td align="left" valign="middle" class="head2">

                     </td>
                     {{--<td align="center" valign="middle" class="head8">--}}
                     {{--<input type="checkbox" {{$member->unionActivities->count() ? 'checked' : ''}} class="check-multiple" data-id="{{$member->id}}" data-aid="{{$id}}">--}}

                     {{--</td>--}}
                 </tr>
     @endforeach
    </tbody>
 </table>
   @else
<table id="list_member" class="table table-bordered">

    <thead>
    <tr>
                <th align="center" valign="middle" class="head1">Mã</th>
                <th align="center" valign="middle" class="head2">Họ Tên</th>
                <th align="center" valign="middle" class="head8">Chi Đoàn</th>
            </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
                <tr>
                    <td align="center" valign="middle" class="head1">{{ $member->student_id }}</td>
                    <td align="left" valign="middle" class="head2">{{$member->first_name .' ' .$member->last_name}}</td>
                    <td align="left" valign="middle" class="head2">{{$member->youthUnion->name}}</td>
                    {{--<td align="center" valign="middle" class="head8">--}}
                    {{--<input type="checkbox" {{$member->unionActivities->count() ? 'checked' : ''}} class="check-multiple" data-id="{{$member->id}}" data-aid="{{$id}}">--}}

                    {{--</td>--}}
                </tr>
    @endforeach
   </tbody>
</table>

@endif
                                </div><!-- /.box-body -->
     </div>
</div>

</div>


   </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
$('a.edit').click(function(e){
e.preventDefault();
var url = $(this).prop('href');

 $.get(url).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
  $('#time_pick').daterangepicker({singleDatePicker: true ,
                                    showDropdowns: true ,
                                    format: 'YYYY-MM-DD'
                                      });
      $('#my-modal').modal('show');
  });
 });
});
  $('#list_member').dataTable({

                      "sPaginationType": "full_numbers",
                      "bProcessing": true,
                      "bPaginate": true,
                      "iDisplayLength": 8,
                      "oLanguage": {"sProcessing":'<div style="position: absolute; left: 50%; top: 50%;"><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'},
                      "bLengthChange": true,
                      "dom": "<\"toolbar\">frtip",
                      "bFilter": true,
                      "bSort": true,
                      "bInfo": true,
                      "bAutoWidth": false


          });

$('a.edit_member').click(function(e){
e.preventDefault();
var url = $(this).prop('href');

 $.get(url).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
  oTable.on('draw.dt' ,function(){
      $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"});

  });

    $('#my-modal').modal('show');
  });
 });
});


$(document).on('change' , '#choose_union' , function(){
     var union_id = $('#choose_union').val();
      var aid = $('#choose_union').data('aid');
      var url = '{{URL::route('table.search.member')}}' +'?union_id='+union_id+'&activity_id='+aid ;
        oTable.ajax.url(url).load();
});


$(document).on('ifToggled','input.check-multiple',function(event){
            var checkbox = $(this).parent();
            checkbox.hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
               var id = $(this).data('id');
               var aid = $(this).data('aid');
               var data = { 'member_id' : id ,
                            'activity_id' : aid} ;
               var url ;

                if($(this).prop('checked')){
                 url = "{{URL::route('school.attach.member')}}";

                 } else{
                url = "{{URL::route('school.detach.member')}}";

                 }

                        $.ajax({
                          type: "POST",
                          url: url ,
                          data: data,
                          success: function(data){
                             $('.fa-spin').remove();
                             checkbox.show();
                             var link = "{{URL::route('ajax.members.activity')}}"+"?activity_id="+aid;
                              $.get(link).done(function(data){
                               $('div.table-responsive').html(data['html']).promise().done(function(){
                                 $('#list_member').dataTable({

                                                     "sPaginationType": "full_numbers",
                                                     "bProcessing": true,
                                                     "bPaginate": true,
                                                     "iDisplayLength": 8,
                                                     "oLanguage": {"sProcessing":'<div style="position: absolute; left: 50%; top: 50%;"><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'},
                                                     "bLengthChange": true,
                                                     "dom": "<\"toolbar\">frtip",
                                                     "bFilter": true,
                                                     "bSort": true,
                                                     "bInfo": true,
                                                     "bAutoWidth": false


                                         });
                               });
                              });

                          },
                          dataType: 'json'
                        });

                });

});


</script>
@stop