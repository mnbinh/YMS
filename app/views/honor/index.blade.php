@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
                {{HTML::style('css/daterangepicker/daterangepicker-bs3.css')}}
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
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div class="box box-solid ">
<div class="box-header">
                                    <h3 class="box-title">Các Đợt Khen Thưởng</h3>

                                </div>
   <div class="box-body ">
   <div class="col-md-4 col-md-offset-4 " style="margin-bottom: 20px">
 {{Form::select('type' , array('available' => 'Các Đợt Khen Thưởng Đang Xét Duyệt' ,'expired' =>'Các Đợt Khen Thưởng Đã Xét Duyệt') , null , array('class'=>'form-control select'))}}

                                  </div>
<div class="contain-period">
@include('honor.partial.period-appoint', array('periods' => $periods))
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
$('select.select').change(function(){
$('div.loading').show();
var url = '{{URL::route('honor.index')}}'+'?type='+$(this).val();
$.get(url).done(function(data){
$('div.contain-period').html(data.html);
$('div.loading').hide();

});
});



});

</script>
@stop