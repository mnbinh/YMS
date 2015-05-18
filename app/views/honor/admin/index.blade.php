@extends('layout.master')

@section('styles')
          {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          {{ HTML::style('css/iCheck/minimal/red.css') }}
           <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>
             <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>
             <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
           <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
           <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
                          {{--<!-- AdminLTE App -->--}}
                              {{--<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>--}}
                              {{--<!-- AdminLTE for demo purposes -->--}}
                              {{--<script src="../../js/AdminLTE/demo.js" type="text/javascript"></script>--}}
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
                        {{HTML::script('js/net/jquery.validate.min.js')}}
           {{--<style>--}}
           {{--div.box-body { min-height: 250px}--}}
           {{--</style>--}}

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản lý Khen Thưởng

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li class="active">Danh Sách Khen Thưởng</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    {{--<h3 class="box-title">Danh sách các chi đoàn</h3>--}}
                                </div><!-- /.box-header -->

                              <div class="box-body">
                              <div class='fuelux row' style="margin-bottom: 10px">
      <div class="dropdown col-md-2">
      <a class="dropdown-toggle btn btn-flat btn-success btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
         Tác Vụ  <span class="caret"></span>
      </a>
                  <ul class="dropdown-menu">
                      <li role="presentation">

                      <a  href="{{URL::route('create.admin.honor')}}" role="menuitem" tabindex="-1" href="" class="add_member" >Thêm</a>
                      </li>

                      <li role="presentation">
           <a href="#" role="menuitem" tabindex="-1" href="" class="excel_member" >Thêm Từ File</a>

                      </li>




          </ul>
         </div>
  <div class="col-md-4 col-md-offset-2 contain-select" style="text-align: center">
  <span class="inline">Năm học:</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="year">

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($years as $year)
    <li data-value="{{$year->year}}"><a href="#">{{$year->year}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="year" readonly="readonly" aria-hidden="true" type="text"/>
</div>

<span class="inline">Hk:</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="semester" >

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($semesters as $semester)
    <li data-value="{{$semester->semester}}"><a href="#">{{"Học Kỳ ".$semester->semester}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="semester" readonly="readonly" aria-hidden="true" type="text"/>
</div>
<div class="clearfix">
</div>

<span class="inline">Đợt:</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="mySelectlist">

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($periods as $period)
    <li data-value="{{$period->id}}"><a href="#">{{$period->name}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="mySelectlist" readonly="readonly" aria-hidden="true" type="text"/>
</div>


</div>

{{--<div class="pull-right">--}}
  {{--{{link_to_route('honor.create','Thêm Đợt Khen Thưởng', array(), array('class' => 'btn btn-info btn-flat add'))}}--}}
{{--</div>--}}
                                </div>

                                   {{ $table->render() }}
                                   {{ $table->script() }}
                                   <div class="clearfix"></div>
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div>
                    </div>

                </section><!-- /.content -->
@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')

 <script type="text/javascript">
 $(document).ready(function(){
 $('#mySelectlist').selectlist();
 $('#year').selectlist();
 $('#year').selectlist('selectByValue', "{{$year_now}}");
 $('#semester').selectlist();
 $('#semester').selectlist('selectByValue', "{{$semester_now}}");
 $(document).on('changed.fu.selectlist','#mySelectlist' , function (event, data) {
var url = '{{URL::route('data.honor')}}' +'?id=' + data.value ;
  oTable.ajax.url(url).load();
 });
 function reloadCombobox(html){
  $('#mySelectlist ul').html(html);
               var markup = $('#mySelectlist').selectlist('destroy');
               $('div.contain-select').append(markup);
           $('#mySelectlist').selectlist();
     var id = $('#mySelectlist').selectlist('selectedItem').value;
     var url = '{{URL::route('data.honor')}}' +'?id=' + id ;
       oTable.ajax.url(url).load();
 }
  $('#year').on('changed.fu.selectlist', function (event, data) {
 var year = data.value;
 var semester = $('#semester').selectlist('selectedItem').value;
  var url = '{{URL::route('ajax.periods')}}' +'?year=' + year+'&semester=' + semester ;
  $.get(url).done(function(data){
      reloadCombobox(data.html);
    });



  });
   $('#semester').on('changed.fu.selectlist', function (event, data) {
  var semester = data.value;
  var year = $('#year').selectlist('selectedItem').value;
   var url = '{{URL::route('ajax.periods')}}' +'?year=' + year+'&semester=' + semester ;
    $.get(url).done(function(data){
    reloadCombobox(data.html);
    });

   });


$('body').on('apply.daterangepicker' ,'#reservation' , function(ev,picker){
console.log(1);
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




// Add by Admin
$('a.add_member').click(function(e){
e.preventDefault();
 var id = $('#mySelectlist').selectlist('selectedItem').value;

var url = $(this).prop('href')+'?period_id='+id;
$.get(url).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
   $('#test') .wizard();

    $( "#member_id" ).autocomplete({
      source:  function(request, response) {
                          $.ajax({
                              url: "{{URL::route('data.member' )}}",
                              dataType: "json",
                              data: {
                                  term: request.term,
                                  union: 'default'
                              },
                              success: function(data) {
                                  response(data);
                              }
                          });
                      } ,
       select: function (event, ui) {
                           $("#member_id").val(ui.item.value);
                           return false;
                       }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
               return $("<li>")
                   .data("item.autocomplete", item)
                   .append("<a>" + item.label + "<br>" + item.union + "</a>")
                   .appendTo(ul);
           };
    $( "#member_id" ).autocomplete( "option", "appendTo", "#my-modal" );
   validator = $("#addForm").validate({
           rules: {
               member_id: {
               required: true ,
               remote: {
               url: "{{URL::route('honor.validate.id')}}",
               type: "get",
               data: {
               period_id : function(){
               return $("#period_id").val();
               }
               }

               }
               }


           },
           messages: {
               member_id: {
               required:  "Hãy điền Mã số Đoàn viên." ,
               remote: "Mã số đoàn viên không hợp lệ"
               }
           }



   });
     $('div.modal-dialog').removeClass('modal-lg');
     $('#my-modal').modal('show');

  });

});

});

// Section to add manual member


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
    $('#my-modal').modal('hide');
     oTable.ajax.reload();
    }
  },
  dataType: 'json'
});
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

$(document).on('click', 'a.edit' ,function(e){
e.preventDefault();
var url = $(this).prop('href');
$.get(url).done(function(data){
$('div.modal-content').html(data.html).promise().done(function(){
    $('#date').daterangepicker({
         showDropdowns: true ,
         format: 'YYYY-MM-DD' ,
          singleDatePicker: true
        });
});
$('#my-modal').modal('show');
$('#my-modal .modal-dialog').removeClass('modal-lg');

});
} );
$(document).on('submit', '#edit_detail' ,function(e){
e.preventDefault();
var url = $(this).prop('action');
var data = $(this).serialize();
$.ajax({
url : url ,
data : data ,
type : "POST" ,
success: function(data){
oTable.ajax.reload();
$("#my-modal").hide();
}
});
} );

});





 </script>
@stop