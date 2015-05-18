@extends('layout.master')

@section('styles')
      <!-- DATA TABLES -->
          {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
          {{ HTML::style('css/iCheck/minimal/red.css') }}
        {{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
           {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
           <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
           <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
                          <!-- AdminLTE App -->

                              <!-- AdminLTE for demo purposes -->


@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản Lý Chi Đoàn
                     </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Quản Lý Chi Đoàn</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                                            <div class="box">
                                                <div class="box-header">
                                                    <h3 class="box-title">Danh sách các chi đoàn</h3>
                                                </div><!-- /.box-header -->

                                              <div class="box-body table-responsive">
                                                      <div>
                                                    {{link_to_route('admin.union.create','Thêm', array(), array('class' => 'btn btn-flat btn-info add'))}}
                                                   {{link_to_route('union.import' , 'Thêm Từ File' , array() ,array('class' => 'btn btn-flat btn-info excel') )}}
                                                  {{link_to_route('unions.destroy' , 'Xóa' , array() ,array('class' => 'btn btn-flat btn-danger delete') )}}
                                                   {{link_to_route('unions.export' , 'Xuất File' , array() ,array('class' => 'btn btn-flat btn-info') )}}
                                                </div>
                                                   {{ $table->render() }}
                                                   {{ $table->script() }}
                                              </div><!-- /.box-body -->
                                            </div><!-- /.box -->




                </section><!-- /.content -->
@stop

@section('modal')
<div class="modal" id="add_union_modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content ">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
var list_choose=[];
var td ;

$("#check_file").on('ifToggled', function(event){
                 if($(this).prop('checked')){
                    $("div.test").show();
                 } else{
                    $("div.test").hide();
                 }
                });
    //Click Delete
 $('a.delete') .click(function(e){
 e.preventDefault();
//alert(list_choose.length);
$.get($(this).prop('href') ,{"id[]" : list_choose} , function(data){
     if(data.status == 'success'){
               list_choose = [];
                  oTable.ajax.reload();
                  }
} );
 });
    //Click New
$('a.add').click(function(e){
e.preventDefault();
 $.get($(this).prop('href')).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
     $('#add_union_modal').modal('show');
  });
 });
});
//Click import ecxel
$('a.excel').click(function(e){
e.preventDefault();
 $.get($(this).prop('href')).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
     $('#add_union_modal').modal('show');
  });
 });
});
//Click Secretary
$(document).on('click','a.secretary',function(e){
e.preventDefault();
 td =  $(this).parents("td");
var url = $(this).prop('href');
$.get(url).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
      $('#add_union_modal').modal('show');
  });
});

});

//Click Edit
$('body').on('click' , 'a.edit' , function(e){
e.preventDefault();
var url = $(this).prop('href');

 $.get(url).done(function(data){
  $('div.modal-content').html(data['html']).promise().done(function(){
      $('#add_union_modal').modal('show');
  });
 });

});

$("body").on('ifToggled','input.check-multiple',function(event){
                if($(this).prop('checked')){
                list_choose.push($(this).data('id'));
                     $(this).parents("tr").css("background-color","yellow");
                 } else{
                 var index = list_choose.indexOf($(this).data('id'));
                 if (index > -1) {
                     list_choose.splice(index, 1);
                 }
                    $(this).parents("tr").css("background-color","");
                 }

                });

$(document).on("submit" ,"#add_union",function(e){
      e.preventDefault();
       $.post(
               $( this ).prop( 'action' ),
               $(this).serialize()
               ,
               function( data ) {
                   //do something with data/response returned by server
                   if(data.status == 'success'){
                   $('#add_union_modal').modal('hide');
                   oTable.ajax.reload();
                   }
               },
               'json'
           );

   });
   $(document).on("submit" ,"#edit_union",function(e){
         e.preventDefault();
          $.ajax({
               method: "PUT" ,
               url  : $( this ).prop( 'action' ),
               dataType: "json" ,
                  data :$(this).serialize() })
                  .done(function( data ) {
                      //do something with data/response returned by server
                      if(data.status == 'success'){
                      $('#add_union_modal').modal('hide');
                      oTable.ajax.reload();
                      }
                  });


      });
   $(document).on("submit" ,"#add_secretary",function(e){
         e.preventDefault();
          $.post(
                  $( this ).prop( 'action' ),
                  $(this).serialize()
                  ,
                  function( data ) {
                      //do something with data/response returned by server
                      if(data.status == 'success'){
                      $('#add_union_modal').modal('hide');
                      td.html(data.secreatary);
                      }
                  },
                  'json'
              );

      });
});
</script>
@stop