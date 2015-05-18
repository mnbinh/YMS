@extends('layout.master')

@section('styles')
               {{ HTML::style('css/iCheck/minimal/red.css') }}
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
                 {{HTML::style("css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />
           {{HTML::script("js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}

               <style type="text/css">
               .box {border-radius: 0px;
                     -webkit-border-radius: 0px;   }
               .control-label {
                 padding-top: 7px;
                 margin-bottom: 0;
                 text-align: right;
               }
               </style>
                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Hoạt Động Chi Đoàn

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">

      <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Đăng Ký</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
    {{ Form::open(array('route' => 'activity.store' ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_activity')) }}
    {{Form::hidden('youth_union_id' ,Confide::user()->youthMember->youthUnion->id , array())}}
     {{--{{Form::hidden('semester_id'  , 5, array())}}--}}
                                    <div class="box-body">
                                        <div class="form-group row">

                                            {{Form::label('name' , 'Tiêu Đề:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-5">
                                            {{Form::text('name'  , null, array('class' =>'form-control' ))}}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            {{Form::label('place' , 'Địa Điểm:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-5">
                                            {{Form::text('place'  , null, array('class' =>'form-control' ))}}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            {{Form::label('time' , 'Thời gian:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-5">
                                            {{Form::text('time'  , null, array('class' =>'form-control' ,'id' => 'time_pick'))}}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            {{Form::label('description' , 'Mô tả hoạt động:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-5">
                                            {{Form::textarea('description'  , null, array('class' =>'text-area form-control' ))}}
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer row">
                                    <div class="col-md-5 col-md-offset-3">

                                        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                     </div>
                                    </div>
                            {{Form::close()}}
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
 $('#time_pick').daterangepicker({singleDatePicker: true ,
                                  showDropdowns: true ,
                                  format: 'YYYY-MM-DD'
                                    });
  $('.text-area').wysihtml5();
});


</script>
@stop