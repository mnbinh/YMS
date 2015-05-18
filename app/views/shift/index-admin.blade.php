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

                        <li class="active"> Danh Sách Đăng Ký</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div class="box contain">
<div class="box-header">
<h3 class="box-title">Danh Sách Đăng Ký Trực </h3>
        <div class="box-tools pull-right">
        </div>
</div>
<div class="box-body ">
<form id="shift" action="{{URL::route('shift.search')}}">
<div class="row" >
    <div class="form-group pull-left" style="margin: 10px">
        <input name="date" type="text" id="date" class="form-control">
    </div>
    <div class="pull-left" style="margin: 10px">
    {{Form::select('time' , array( '1' => 'Buổi Sáng' , '2' => 'Buổi Chiều'),null,array('class'=>'form-control'))}}
    </div>
     <div class="pull-left" style="margin: 10px">
     {{Form::select('gate' , array('1' => 'Cổng 1' ,'2' => 'Cổng 2'),null,array('class'=>'form-control'))}}
     </div>
  <div class="pull-left" style="margin: 10px">
  {{Form::submit('Tìm' , array('class'=> 'btn btn-flat btn-info'))}}
  </div>
    <div class="pull-right" style="margin: 10px">
    <a class="btn btn-flat btn-info">Chọn số người trực</a>
    </div>
</div>
<div class="content">
</div>

</form>
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

  $('#date').daterangepicker({

                  showDropdowns: true ,
                  format: 'YYYY-MM-DD' ,
                   singleDatePicker: true
                    });
$("#shift").submit(function(e){
e.preventDefault();

if(validator.form()){
$("div.loading").show();


var url = $(this).prop('action');
var data = $(this).serialize();

$.ajax({
url : url ,
data : data ,
type : 'POST' ,
success: function(data){
$('div.content').html(data.html);
$('div.loading').hide();
}
});
}
else{}
});
 $.validator.setDefaults({
     highlight: function(element) {
         $(element).closest('.form-group').addClass('has-error');
     },
     unhighlight: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
     },
     errorElement: 'span',
     errorClass: 'error',
     errorPlacement: function(error, element) {
         if(element.parent('.input-group').length) {
             error.insertAfter(element.parent());
         } else {
             error.insertAfter(element);
         }
     }
 });
var validator = $("#shift").validate({
        rules: {
            date: {
            required: true ,
            date: true
            }
        },
        messages: {
            date: {
            required:  "Hãy điền Mã số Đoàn viên." ,
            date: "Sai định dạng"
            }
        }
});

});
</script>
@stop