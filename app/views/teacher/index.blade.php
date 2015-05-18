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
                        Quản lý Đoàn Viên

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li class="active">  Quản lý Đoàn Viên</li>
                    </ol>
                </section>

                <!-- Main content -->
  <section class="content">
<div class="box">
<div class="box-header">
<h3 class="box-title">Danh Sách Giảng Viên</h3>
        <div class="box-tools pull-right">
        </div>
</div>
<div class="box-body ">
<div class="row">
        <div class="dropdown col-md-2 ">
                                            <a class="dropdown-toggle btn btn-flat btn-success btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
                                               Tác Vụ  <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li role="presentation">

                                                <a  href="{{URL::route('teacher.create')}}" role="menuitem" tabindex="-1" href="" class="add-teacher" >Thêm Mới </a>
                                                </li>

                                                <li role="presentation">
                                     <a href="{{URL::route('teacher.create.excel')}}" role="menuitem" tabindex="-1" href="" class="excel_member" >Thêm Từ File</a>

                                                </li>
                                                              </li>


                                       <li role="presentation">
                                             <a href="members.destroy-multiple" role="menuitem" tabindex="-1" href="" class="destroy_member" >Xóa</a>

                                                        </li>
                     <li role="presentation">
                                                   <a role="menuitem" tabindex="-1" href="" class="edit_member" >In</a>

                                                              </li>
                          <li role="presentation">
                   <a href="{{URL::route('teacher.export')}}" role="menuitem" tabindex="-1" href="" class="export_member" >Xuất File Ecxel</a>
                 </li>
                                            </ul>
       </div>

</div>
{{$table->render()}}
{{$table->script()}}
<div class="clearfix">
</div>
</div>
</div>
    </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal" id="add-teacher">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="fuelux">
        <div class="wizard" id="test">
    <ul class="steps">
        <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Require<span class="chevron"></span></li>
        <li data-step="2"><span class="badge">2</span>Additional<span class="chevron"></span></li>
        {{--<li data-step="3" data-name="template"><span class="badge">3</span>Template<span class="chevron"></span></li>--}}
     </ul>




  {{Form::open(array('url' => URL::route('teacher.store') , 'id' => 'addForm' , 'class' =>'form-horizontal'))}}
             <div class="step-content">
                 <!-- The first panel -->
                 <div class="step-pane active" data-step="1">


                    <div class="form-group" style="margin: 10px;">
                                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                      {{Form::label('email' , 'Email' , array('class'=>'col-xs-3 control-label'))}}
                        <div class="col-xs-6">
                      {{Form::text('email'  , null, array('class' =>'form-control'))}}
                  </div>
                        </div>

                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('teacher_id' , 'Mã số Cán Bộ' , array('class'=>'col-xs-3 control-label'))}}
                          <div class="col-xs-6">
                            {{Form::text('teacher_id'  , null, array('class' =>'form-control'))}}
                       </div>
                       </div>

                 </div>

                 <!-- The second panel -->
                 <div class="step-pane" data-step="2">
                      {{--<div class="form-group" style="margin: 10px;">--}}
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{--{{Form::label('bonus_id' , 'Loại' , array('class'=>'col-xs-3 control-label'))}}--}}
                              {{--<div class="col-xs-6">--}}
                            {{--{{ Form::select('bonus_id', $type, null, array('class' => 'form-control')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('first_name' , 'Họ' , array('class'=>'col-xs-3 control-label'))}}
                          <div class="col-xs-6">
                            {{Form::text('first_name'  , null, array('class' =>'form-control'))}}
                       </div>
                       </div>
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('last_name' , 'Tên' , array('class'=>'col-xs-3 control-label'))}}
                          <div class="col-xs-6">
                            {{Form::text('last_name'  , null, array('class' =>'form-control'))}}
                       </div>
                       </div>
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('bird_date' , 'Ngày sinh' , array('class'=>'col-xs-3 control-label'))}}
                          <div class="col-xs-6">
                            {{Form::text('bird_date'  , null, array('class' =>'form-control time_pick'))}}
                       </div>
                       </div>

                 </div>

             </div>

        {{Form::close()}}

      </div>
      </div>
         <div class="modal-footer">
                                                             <button type="button" class="btn btn-flat btn-danger previous"><span class="fa fa-arrow-left"></span> Prev</button>
                                                             <button type="button" class="btn btn-flat btn-info next" data-last="Complete">Next <span class="fa fa-arrow-right"></span></button>
         </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){




 $('a.excel_teacher').click(function(e){
e.preventDefault()
var url = $(this).prop('href');
$.get(url).done(function(data){
$('div.modal-content').html(data.html).promise().done(function(){
   $('#my-modal').modal('show');
});

});
 });

// Section to add manual member
 $('#test') .wizard();
$('a.add-teacher').click(function(e){
e.preventDefault();
 $('#add-teacher').modal('show');

});
$(document).on('click' , 'button.previous' ,function(){
$('#test').wizard('previous');
});
$(document).on('click' , 'button.next' ,function(){
$('#test').wizard('next');
});
$(document).on('click' , 'button.find-member' , function(){
/*$('div[data-step="1"]').append('<div style="min-height: 20px"></div>');*/
});

$(document).on('actionclicked.fu.wizard' , '#test' , function(e,d){
//Before display to user
console.log(validator)
  if(validator.form()){


        }
        else{
          e.preventDefault();
        }

});
$(document).on('changed.fu.wizard','#test' , function(e , d){
//After display to user
if(d.step == 2)
{


$('button.next').html('Save <span class="fa fa-arrow-right"></span>');
}
else
{
$('button.next').html('Next <span class="fa fa-arrow-right"></span>');
}

});
$(document).on('finished.fu.wizard' , '#test' , function(e){
var url = $('#addForm').prop('action');
var data = $('#addForm').serialize()
$.ajax({
  type: "POST",
  url: url,
  data: data,
  success: function(data){
    if(data.msg == 'success'){
    $('#add-teacher').modal('hide');
     oTable.ajax.reload();
    }
  },
  dataType: 'json'
});
});

  $('.time_pick').daterangepicker({

                  showDropdowns: true ,
                  format: 'YYYY-MM-DD' ,
                   singleDatePicker: true
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
 var validator = $("#addForm").validate({
        rules: {
            teacher_id: {
            required: true ,
            remote: "{{URL::route('check.teacher.id')}}"
            } ,

            email: {
                required: true,
                email: true ,
                remote: "{{URL::route('check.teacher.email')}}"
            }
        },
        messages: {
            student_id: {
            required:  "Hãy điền Mã số Cán Bộ." ,
            remote: "Mã số đã tồn tại"
            },

            email: {
               remote: "Địa chỉ Email đã tồn tại",
                required: "Hãy nhập 1 địa chỉ email hợp lệ",
                email:"Địa chỉ email không hợp lệ"
            }
        }



});

});

</script>
@stop