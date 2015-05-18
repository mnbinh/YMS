@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
               {{HTML::style('css/net/jquery-ui.theme.min.css')}}
            {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           {{HTML::script('js/net/jquery-ui.min.js')}}
           {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
           <style type="text/css">
          .timeline > li.time-label > span {border-radius: 0px; -webkit-border-radius: 0px;}

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
                    Quản Lý Đoàn Phí
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Quản Lý Đoàn Phí</a></li>
                        <li class="active">Thu Đoàn Phí </li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">
    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Quản Lý Thu Đoàn Phí</h3>
                                </div><!-- /.box-header -->


                              <div class="box-body table-responsive">
<div class="contain-all">
<div class="fuelux" style="margin-bottom: 5px">
<div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="mySelectlist">
  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($years as $year)
    <li data-value="{{$year->id}}"><a href="#">{{$year->year}}</a></li>
@endforeach

  </ul>
</div>

<div class="pull-right">
{{link_to_route('admin.allow.pay', 'Duyệt Đoàn Phí' , array('year_id' => $year_id) , array('class' => 'btn btn-flat btn-info check'))}}
</div>
</div>
<div>
{{--<div style="clear: both" >--}}
{{--</div>--}}
                                   {{ $table->render() }}
                                   {{ $table->script() }}
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
</div>
</div>

                        </div>
               </div>



    </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
 $('#mySelectlist').selectlist();
 $('#mySelectlist').selectlist('selectByValue', '{{$year_id}}');
 $('#mySelectlist').on('changed.fu.selectlist', function (event, data) {
var url = '{{URL::route('admin.data.union.fee')}}' +'?year_id=' + data.value ;
var link = "{{URL::route('admin.allow.pay')}}" + "?year_id=" + data.value ;
$('a.check').prop('href' , link);

  oTable.ajax.url(url).load();
 });

 $('a.check').click(function(e){
 e.preventDefault();
  $.get($(this).prop('href')).done(function(data){
   $('div.modal-content').html(data['html']).promise().done(function(){
    $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"});
      $('#my_modal').modal('show');
   });
  });
 });

  $(document).on('ifToggled','input.check-multiple',function(event){
              var checkbox = $(this).parent();
              checkbox.hide().parent().append('<i class="fa fa-refresh fa-spin load"></i>');
                 var uid = $(this).data('uid');
                 var yid = $(this).data('yid');
                 var month= $(this).data('month');
                 var data = { 'month' : month ,
                              'union_id' : uid ,
                              'year_id' : yid} ;
                 var url ;

                  if($(this).prop('checked')){
                   url = "{{URL::route('admin.union.pay')}}";

                   } else{
                  url = "{{URL::route('admin.union.re.pay')}}";

                   }
                          $.ajax({
                            type: "POST",
                            url: url ,
                            data: data,
                            success: function(data){

                               $('.load').remove();
                               checkbox.show();
                               $(data.jquery).text(data.total);

                            },
                            dataType: 'json'
                          });

                  });
  $(document).on('change' , '.select' , function(){
  $('div.loading').show();
   var year_id = $(this).data('yid');
   var union_id = $(this).val();
   var url = "{{URL::route('allow.change.union')}}"+"?year_id="+ year_id+"&union_id="+union_id ;
   $.get(url).done(function(data){
        $('div.table-fee').html(data['html']);
         $("input.check-multiple").iCheck({checkboxClass: "icheckbox_minimal-red"});
        $('div.loading').hide();
   });
  });
});

</script>
@stop