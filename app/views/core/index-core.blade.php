@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}

           {{HTML::script('js/net/jquery-ui.min.js')}}
           <style type="text/css">
           .ui-autocomplete { z-index: 5000;}
           </style>
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
             <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
             <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
                     {{HTML::script('js/net/jquery.validate.min.js')}}
                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản Lý Chi Đoàn

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Quản lý chi đoàn</a></li>
                        <li class="active">Lực lượng nòng cốt</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-xs-12">
                     <div class="box box-info" >
                                <div class="box-header">
                                <i class="fa fa-gift fa-lg "></i>
                                    <h3 class="box-title">Đề Cữ Lực lượng Nòng Cốt</h3>
                                </div><!-- /.box-header -->

                              <div class="box-body ">
 <div class='fuelux row' style="margin-bottom: 10px">
 <div class="dropdown col-md-2">
      <a class="dropdown-toggle btn btn-flat btn-success btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
          Tác Vụ  <span class="caret"></span>
       </a>
                   <ul class="dropdown-menu">
                       <li role="presentation">
                            @if($exist)
                       <a  href="{{URL::route('create.core.member' , array('list_id' => $list->id))}}" role="menuitem" tabindex="-1" href="" class="add_member" >Thêm</a>
                            @else
                        <a  href="{{URL::route('create.core.member' , array('list_id' => "default"))}}" role="menuitem" tabindex="-1" href="" class="add_member" >Thêm</a>


                            @endif
                       </li>

                       <li role="presentation">
            <a href="#" role="menuitem" tabindex="-1" href="" class="excel_member" >Thêm Từ File</a>

                       </li>




           </ul>
 </div>
  <div class="col-md-4 col-md-offset-2 contain-select" style="text-align: center">
<span class="inline">Niên Khóa :</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="mySelectlist">

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($cores as $core)
    <li data-value="{{$core->id}}"><a href="#">{{$core->name}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="mySelectlist" readonly="readonly" aria-hidden="true" type="text"/>
</div>


</div>


</div>


       <div class="callout callout-danger {{$exist ? "none" : ""}}">
         <h4><i class="fa fa-flash fa-lg "></i>  <b>Chưa lập danh sách</b></h4>

        <p>
       {{link_to_route('store.list.core','Lập Danh Sách', array(), array('class' => 'btn btn-info btn-flat new' ))}}
         </p>
        </div>
        <div class="container-hide {{ !$exist ? "none" : ""}}">
           {{--<div>--}}
             {{--{{link_to_route('store.single','Thêm', array(), array('class' => 'btn btn-info btn-flat add'))}}--}}
           {{--</div>--}}
                                   {{ $table->render() }}
                                   {{ $table->script() }}
                                     <div class="clearfix"></div>

        </div>



                              </div><!-- /.box-body -->
                              </div><!-- /.box -->


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
//Section to change select list
//initialize list
 $('#mySelectlist').selectlist();

 $(document).on('changed.fu.selectlist','#mySelectlist' , function (event, data) {

  var core_id = data.value;
  var url = '{{URL::route("check.list.core")}}'+ "?id="+ core_id;
$.get(url).done(function(data){
$('a.add_member').prop('href',data.link);
if(data.exist)
{
$('div.callout').hide();
$('div.container-hide').show();
var url = '{{URL::route('table.appoint')}}' +'?lid=' + data.lid ;
  oTable.ajax.url(url).load();
}
else{
$('div.callout').show();
$('div.container-hide').hide();
}

});

 });


//End Section change select list

//Section to click new list
$('a.new').click(function(e){
e.preventDefault();
var url = $(this).prop('href');
var data = {
'core_id' : $('#mySelectlist').selectlist('selectedItem').value

}
$.ajax({
  type: "POST",
  url: url,
  data: data,
  success: function(data){
$('div.callout').hide();
$('div.container-hide').show();
$('a.add_member').prop('href',data.link);
var url = '{{URL::route('table.appoint')}}' +'?lid=' + data.lid ;
  oTable.ajax.url(url).load();

  },
  dataType: 'json'
});
});
//End Section


//Section to add member to list

$('a.add_member').click(function(e){

e.preventDefault();
var url = $(this).prop('href');
$.get(url).done(function(data){
if(data.exist){
  $('div.modal-content').html(data['html']).promise().done(function(){
   $('#test') .wizard();
  $(".text-area").wysihtml5();
    $( "#member_id" ).autocomplete({
      source:  function(request, response) {
                          $.ajax({
                              url: "{{URL::route('data.member' )}}",
                              dataType: "json",
                              data: {
                                  term: request.term,
                                  union: '{{$union->id}}'
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
               url: "{{URL::route('core.validate.id')}}",
               type: "get",
               data: {
               core_id : function(){
               return $('#mySelectlist').selectlist('selectedItem').value ;
               } ,
               union_id: function() {
                 return  '{{$union->id}}';
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
} else
{
alert('List Core is not exisst');
}

});
$(document).on('actionclicked.fu.wizard' , '#test' , function(e,d){
//Before display to user

  if(validator.form()){


        }
        else{
          e.preventDefault();
        }

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

//Wizzza Control
$(document).on('click' , 'button.previous' ,function(){
$('#test').wizard('previous');
});
$(document).on('click' , 'button.next' ,function(){
$('#test').wizard('next');
});
$(document).on('click' , 'button.find-member' , function(){
/*$('div[data-step="1"]').append('<div style="min-height: 20px"></div>');*/
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
//End Wizza controll

//End Section
//Section show explain
$(document).on('click', 'a.explain' , function(e){
e.preventDefault();
var explain = $(this).parent().find('div.none').clone();
var body = $('   <div class="modal-body">  </div>') ;
var footer = $('   <div class="modal-footer">       <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button> </div>') ;
$('div.modal-content').append(body);
$('div.modal-body').append(explain)
$('div.modal-content').append(footer);
$('.modal-content div.none').removeClass('none');
$('#my-modal').modal('show');
})
$('#my-modal').on('hidden.bs.modal', function () {
    // do something…
    $('div.modal-content').html('');
});
});

</script>
@stop