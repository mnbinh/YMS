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
<div class="col-lg-9">
 <div class="box box-solid">
                                <div class="box-header" >
                                    <h3 class="box-title">{{$activity->name}}</h3>
                                   <div class="box-tools pull-right">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn btn-flat btn-success btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
                                                Cập nhật <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li role="presentation">

                                                <a role="menuitem" tabindex="-1" href="{{URL::route('activity.edit' , array('activity'=>$activity->id))}}" class="edit" >Chỉnh sữa thông tin</a>
                                                </li>

                                                <li role="presentation">
                                     <a role="menuitem" tabindex="-1" href="{{URL::route('get.member' , array('id'=>$activity->id))}}" class="edit_member" >Cập nhật danh sách Tham gia</a>

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
                                        <dt class="text-muted"><b>Tình trạng:</b></dt>
                                        @if($activity->confirm)
                                        <dd><div class="label bg-green">
                                        Duyệt

                                        </div></dd>
                                        @else
                                        <dd><div class="label bg-red">
                                        Chờ Duyệt

                                        </div></dd>
                                        @endif
                                      </dl>
                                      </div>
                                    </div>
                                       <div class="row" style="margin-bottom: 10px">
                                         <div class="col-md-6">
                                               <dl class="dl-horizontal">
                                             <dt class="text-muted"><b>Thời gian:</b></dt>
                                              <dd>{{$activity->time->toDateString()}}</dd>
                                             <dt class="text-muted"><b>Địa Điểm:</b></dt>
                                              <dd>Cần Thơ</dd>
                                             <dt class="text-muted"><b>Học Kỳ:</b></dt>
                                              <dd>{{'Học kỳ ' .$activity->semester->semester .'/'.$activity->semester->year  }}</dd>
                                                 </dl>
                                         </div>
                                         <div class="col-md-6">
                                               <dl class="dl-horizontal">
                                             <dt class="text-muted"><b>Ngày tạo:</b></dt>
                                              <dd>{{$activity->created_at->toDateString()}}</dd>
                                                 <dt class="text-muted"><b>Chi Đoàn:</b></dt>
                                                 <dd>{{$activity->youthUnion->name}}</dd>

                                                <dt class="text-muted"><b>Số lượng Đoàn viên:</b></dt>
                                                <dd><div class="label bg-green">
                                                {{$activity->youthMembers->count()}}
                                                </div>
                                                </dd>
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
<div class="col-lg-3">
da
</div>

</div>


   </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog ">
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
$('a.edit_member').click(function(e){
e.preventDefault();
var url = $(this).prop('href');

 $.get(url).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
  oTable =  $('#list_member').DataTable({

                      "sPaginationType": "full_numbers",
                      "bProcessing": true,
                      "bPaginate": true,
                      "iDisplayLength": 8,
                      "oLanguage": {"sProcessing":"<div style=\"background-color: #00ca6d ;position: absolute;\n    left: 100px;\n    top: 150px;  \">He He<\/div>"},
                      "bLengthChange": true,
                      "dom": "<\"toolbar\">frtip",
                      "bFilter": true,
                      "bSort": true,
                      "bInfo": true,
                      "bAutoWidth": false


          });

      $('#my-modal').modal('show');
  });
 });
});

$(document).on('draw.dt' , '#list_member' , function() {
    $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"});
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
                 url = "{{URL::route('attach.member')}}";

                 } else{
                url = "{{URL::route('detach.member')}}";

                 }
                        $.ajax({
                          type: "POST",
                          url: url ,
                          data: data,
                          success: function(data){
                             $('.fa-spin').remove();
                             checkbox.show();
                          },
                          dataType: 'json'
                        });

                });

});


</script>
@stop