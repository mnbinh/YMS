@extends('layout.master')

@section('styles')

                          {{--<!-- AdminLTE App -->--}}
                              {{--<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>--}}
                              {{--<!-- AdminLTE for demo purposes -->--}}
                              {{--<script src="../../js/AdminLTE/demo.js" type="text/javascript"></script>--}}
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
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
                            <div class="box">
                                <div class="box-header">
                                    {{--<h3 class="box-title">Danh sách các chi đoàn</h3>--}}
                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">


                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div>
                    </div>

                </section><!-- /.content -->
@stop

@section('modal')
<div class="modal" id="">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')

</script>
@stop