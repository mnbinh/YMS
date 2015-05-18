@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
                {{HTML::style('css/daterangepicker/daterangepicker-bs3.css')}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"
      xmlns="http://www.w3.org/1999/html">
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
           <style type="text/css">
           .ui-autocomplete { z-index: 5000;}
           </style>
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
             <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
             <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
                       {{HTML::script('js/plugins/daterangepicker/daterangepicker.js')}}

                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản lý Khen Thưởng

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Đợt Khen Thưởng</a></li>
                        <li class="active">Chi Tiết</li>
                    </ol>
                </section>

                <!-- Main content -->
    <section class="content">
 <div class="row">
    <div class="col-lg-7">
<div class="box">
<div class="box-header">
<h3 class="box-title">Danh Sách Khen Thưởng Được Đề Cử Từ Các Chi Đoàn</h3>
</div>
<div class="box-body">
<div class="row" style="text-align: center">


<span class="inline">Chi Đoàn:</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="list">

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
<li data-value="default"><a href="#">Từ Tất Cả Các Chi Đoán</a></li>
@foreach ($lists as $list)
    <li data-value="{{$list->id}}"><a href="#">{{$list->name}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="list" readonly="readonly" aria-hidden="true" type="text"/>
</div>

</div>
{{$table->render()}}
{{$table->script()}}
<div class="clearfix">
</div>
</div>
</div>
</div>
<div class="col-lg-5">
<div class="box">
<div class="box-header">
<h3 class="box-title">Thông Tin</h3>
</div>
<div class="box-body">
<dl class="dl-horizontal">
      <dt class="text-muted"><b>Năm Học:</b></dt>
                   <dd>{{$semester->year}}</dd>
        <dt class="text-muted"><b>Học Kỳ:</b></dt>
                         <dd>{{$semester->semester}}</dd>
         <dt class="text-muted"><b>Trạng Thái:</b></dt>
          <dd>
          @if($period->end_date->gte(\Carbon\Carbon::now()))
          <div class="label bg-red">Nộp Danh Sách</div>
          @elseif($period->expired_date->gte(\Carbon\Carbon::now()))
                    <div class="label bg-red">Xét Duyệt</div>
          @else
                              <div class="label bg-red">Chính Thức</div>
          @endif
          </dd>
         <dt class="text-muted"><b>Số Chi Đoàn Đã Nộp DS:</b></dt>
                   <dd><div class="label bg-blue">{{$lists->count()}}</div></dd>
         <dt class="text-muted"><b>Nội Dung:</b></dt>
          <dd>{{$period->description}}</dd>

             </dl>
</div>
</div>
</div>
</div>
    </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
 $('#list').selectlist();
 $(document).on('changed.fu.selectlist','#list' , function (event, data) {
 var url = '{{URL::route('ajax.detail.of.list')}}' +'?period_id={{$period->id}}' +'&list_id='+ data.value ;
   oTable.ajax.url(url).load();
  });

  $(document).on('ifToggled','input.check-multiple',function(event){
              var checkbox = $(this).parent();
              checkbox.hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
                 var detail_id = $(this).data('did');

                 var data = { 'detail_id' : detail_id } ;
                 var url ;

                  if($(this).prop('checked')){
                   url = "{{URL::route('confirm.honor.member')}}";

                   } else{
                  url = "{{URL::route('unconfirm.honor.member')}}";

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
 $(document).on('click','a.show_activity' , function(e){
 e.preventDefault();
  var url = $(this).prop('href');
  $.get(url).done(function(data){
   $('div.modal-content').html(data['html']).promise().done(function(){
   $('div.modal-dialog').addClass('modal-lg');
       $('#my-modal').modal('show');
   });
  });
 });
  $(document).on('change' , '#select_type' , function(e){
  var member_id = $(this).data('id');
  var semester_id = $(this).data('sid');

var url = "{{URL::route('partial.member.activities')}}" + '?type='+$(this).val()+'&member_id='+member_id +'&semester_id='+semester_id;
        $.ajax({
        beforeSend: function(){
        $('div.loading').show();
        } ,
        dataType : "json" ,
        url : url ,
        method : "GET" ,
        success: function(data){

        $('div.content').html(data.html).promise().done(function(){
        $('div.loading').hide();
        });
        }
        });
  });

});


</script>
@stop