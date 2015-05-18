@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản lý Khen Thưởng

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-xs-12">
                     <div class="box box-info" >
                                <div class="box-header">
                                <i class="fa fa-gift fa-lg "></i>
                                    <h3 class="box-title">{{$period->name}}</h3>
                                </div><!-- /.box-header -->

                              <div class="box-body table-responsive">



      @if($exist)


        <div>
     {{link_to_route('store.single','Thêm', array('id'=>$list->id), array('class' => 'btn btn-info btn-flat add'))}}
        </div>
            <!-- Render table-->
                                   {{ $table->render() }}
                                   {{ $table->script() }}


      @else
       <div class="callout callout-danger">
         <h4><i class="fa fa-flash fa-lg "></i>  <b>Chưa lập danh sách</b></h4>

        <p>
       {{link_to_route('new.list.honor','Lập Danh Sách', array(), array('class' => 'btn btn-info btn-flat new' , 'data-pid' =>$period->id))}}
         </p>
        </div>
        <div class="container-hide">
           <div>
             {{link_to_route('store.single','Thêm', array(), array('class' => 'btn btn-info btn-flat add'))}}
           </div>
                                   {{ $table->render() }}
                                   {{ $table->script() }}
        </div>
      @endif


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

<div class="modal" id="add-bonus">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="fuelux">
        <div class="wizard" id="test">
    <ul class="steps">
        <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Chọn Sinh Viên<span class="chevron"></span></li>
        <li data-step="2"><span class="badge">2</span>Chi Tiết Khen Thưởng<span class="chevron"></span></li>
        {{--<li data-step="3" data-name="template"><span class="badge">3</span>Template<span class="chevron"></span></li>--}}
     </ul>




  <form id="addForm"   method="post" class="form-horizontal">
             <div class="step-content">
                 <!-- The first panel -->
                 <div class="step-pane active" data-step="1">
                     <div class="form-group member-id" style="margin: 10px;">
                                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                              {{Form::label('member_id' , 'Chọn Đoàn viên :' ,array('class'=>'col-xs-3 control-label'))}}
                                              <div class="col-xs-6">
                                              <div class="input-group">
                                              {{Form::text('member_id'  , null, array('class' =>'form-control' ,'id' =>'auto-find'))}}
                                              <span class="input-group-btn">
                                                   <button class="btn btn-info btn-flat find-member" type="button"><i class="fa fa-search"></i></button>
                                              </span>
                                              </div>
                                              </div>

                     </div>




                 </div>

                 <!-- The second panel -->
                 <div class="step-pane" data-step="2">
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('bonus_id' , 'Loại' , array('class'=>'col-xs-3 control-label'))}}
                              <div class="col-xs-6">
                            {{ Form::select('bonus_id', $type, null, array('class' => 'form-control')) }}
                        </div>
                        </div>
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('suggested' , 'Đơn vị đề nghị' , array('class'=>'col-xs-3 control-label'))}}
                          <div class="col-xs-6">
                            {{Form::text('suggested'  , null, array('class' =>'form-control'))}}
                       </div>
                       </div>
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('detail' , 'Chi tiết' , array('class'=>'col-xs-3 control-label'))}}
                              <div class="col-xs-6">
                            {{Form::textarea('detail'  , null, array('class' =>'form-control'))}}
                        </div>
                      </div>

                 </div>

             </div>

         </form>

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
$('div.container-hide').hide();

$('#test') .wizard();

    $( "#auto-find" ).autocomplete({
                            source:  function(request, response) {
                                                $.ajax({
                                                    url: "{{URL::route('data.member' )}}",
                                                    dataType: "json",
                                                    data: {
                                                        term: request.term,
                                                        union: "{{Confide::user()->youthMember->youth_union_id}}"
                                                    },
                                                    success: function(data) {
                                                        response(data);
                                                    }
                                                });
                                            } ,
                             select: function (event, ui) {
                                                 $("#auto-find").val(ui.item.value);
                                                 return false;
                                             }
                          }).data("ui-autocomplete")._renderItem = function (ul, item) {
                                     return $("<li>")
                                         .data("item.autocomplete", item)
                                         .append("<a>" + item.label + "<br>" + item.union + "</a>")
                                         .appendTo(ul);
                                 };
    $( "#auto-find" ).autocomplete( "option", "appendTo", "#add-bonus" );
$('a.add').click(function(e){

e.preventDefault();
$('#add-bonus').modal('show');
});
$('a.new').click(function(e){

e.preventDefault();
var url = $(this).prop('href');
var data = {
'period_id' : $(this).data('pid')

}
$.ajax({
  type: "POST",
  url: url,
  data: data,
  success: function(data){
$('div.callout').remove();
$('div.container-hide').show();
$('a.add').prop('href',data.link);
var url = '{{URL::route('data.honor')}}' +'?lid=' + data.lid ;
  oTable.ajax.url(url).load();

  },
  dataType: 'json'
});
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
});
$(document).on('changed.fu.wizard','#test' , function(e , d){
//After display to user
if(d.step == 2)
{
$('button.next').html('Save <span class="fa fa-save"></span>');
}
else
{
$('button.next').html('Next <span class="fa fa-arrow-right"></span>');
}

});
$(document).on('finished.fu.wizard' , '#test' , function(e){
var url = $('a.add').prop('href');
var data = $('#addForm').serialize()
$.ajax({
  type: "POST",
  url: url,
  data: data,
  success: function(data){
    if(data.msg == 'success'){
    $('#add-bonus').modal('hide');
     oTable.ajax.reload();
    }
  },
  dataType: 'json'
});
});

});

</script>
@stop