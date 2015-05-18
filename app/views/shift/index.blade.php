@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
                {{--{{HTML::style('css/daterangepicker/daterangepicker-bs3.css')}}--}}
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
           <style type="text/css">
           .ui-autocomplete { z-index: 5000;}
           </style>
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
   <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>
   <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>
   <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />
             {{HTML::script('js/net/jquery.validate.min.js')}}
             <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
             <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>

                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản Lý Trực Nhật

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li class="active"> Đăng Ký Trực</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div class="box contain">
@include('shift.partial.table', array('day' => $day , 'n' => $n ));
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
@if(isset($tds))
@foreach($tds as $td)
$("{{$td}}").find('a').addClass("btn-success").removeClass('btn-info').html('<i class=" fa  fa-check-circle"></i>');
@endforeach

@endif

$(document).on('click', 'td a' , function(e){
  var td = $(this).parent();
  var a = $(this) ;
    a.hide();
 td.append('<i class="fa fa-refresh fa-spin load"></i>');
var date = $(this).data('date');
var time = $(this).data('time');
var gate = $(this).data('gate');
if($(this).hasClass('btn-success')){
var url = "{{URL::route('shifts.restore')}}" ;
$.ajax({
url : url ,
data: {"date" : date , "time" : time , "gate" : gate} ,
type : "POST" ,
success: function(data){
$(".load").remove();
  a.show().removeClass('btn-success').addClass('btn-info').html('<i class=" fa   fa-users"></i>') ;
showAlert('success','Thành công' , data.message);

}
})
}
else{

var url = "{{URL::route('shifts.store')}}";
$.ajax({
url : url ,
data: {"date" : date , "time" : time , "gate" : gate} ,
type : "POST" ,
success: function(data){
$(".load").remove();
a.show().removeClass('btn-info').addClass('btn-success').html('<i class=" fa  fa-check-circle"></i>');
showAlert('success','Thành công' , data.message);

}
})
}
});

$(document).on('click','a.change' , function(e){
e.preventDefault();
var url = $(this).prop('href');
$('div.loading').show();
$.get(url).done(function(data){
if(data.flag){
$('div.contain').html(data.html).promise().done(function(){
data.tds.forEach(function(td) {
   $(td).find('a').addClass("btn-success").removeClass('btn-info').html('<i class=" fa  fa-check-circle"></i>');

});

});

$('div.loading').hide();

}else
{
$('div.loading').hide();
showAlert('danger' ,'Thất Bại' ,data.msg);
}
});
});

});
$(document).on('click' , 'a.detail' , function(e){
e.preventDefault();
var url = $(this).prop('href');
$.get(url).done(function(data){
$('div.modal-content').html(data.html);
$('#my-modal').modal('show');
});
});
</script>
@stop