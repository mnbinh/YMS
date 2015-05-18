@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
            {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}
           {{--<link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">--}}
           {{--<script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>--}}
           {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
           <style type="text/css">
          .timeline > li.time-label > span {border-radius: 0px; -webkit-border-radius: 0px;}
           </style>
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
             {{--<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>--}}
             {{HTML::script('js/net/datatable-min.1.10.5.js')}}
          {{--<script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>--}}
             {{HTML::script('js/net/datatable.bootstrap.js')}}

                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản Lý Hoạt Động

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Quản Lý Hoạt Động</a></li>
                        <li class="active">Hoạt Động Đoàn Khoa</li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">
                    <div class="row" style="margin-right: 30px; margin-bottom: 10px;">
            <div class="col-md-3">
            {{Form::select('type',array('default'=> 'Tất Cả' ,'member' => 'Cá Nhân' ,'union'=> 'Tập Thể'),null,array('class'=> 'form-control', 'id' => 'select'))}}

            </div>
{{link_to_route('school.activity.new' , 'Tạo Hoạt Động Mới' , array() , array('class'=>'btn btn-info btn-flat pull-right'))}}

                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- The time line -->

                            <ul class="timeline">

                                 <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                      {{date('d-m-Y')}}
                                    </span>
                                </li >
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                    @foreach($activities as $activity)
                                <li >

                                    <i class="fa fa-bell  bg-blue"></i>
                                    <div class="timeline-item">

                                        <span class="time"><i class="fa fa-clock-o"></i> {{  $activity->date->diffForHumans()}}</span>
                                        <h3 class="timeline-header">{{link_to_route('school.activity.show',$activity->name,array('activity'=>$activity->id))}}({{$activity->place}}) </h3>
                                        <div class="timeline-body">
                                           <pre> {{$activity->description}} </pre>
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-primary btn-xs btn-flat">Read more</a>
                                            <a class="btn btn-danger btn-xs btn-flat">Delete</a>
                                        </div>
                                    </div>
                                </li>
                    @endforeach
                                <!-- END timeline item -->
                                <!-- timeline item -->

                                <li>
                                    <i class="fa fa-clock-o"></i>
                                </li>
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->



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
$('#select').change(function(){
var url = "{{URL::route('admin.school.activity')}}" + '?type='+$(this).val();
        $.ajax({
        beforeSend: function(){
        $('div.loading').show();
        } ,
        dataType : "json" ,
        url : url ,
        method : "GET" ,
        success: function(data){

        $('ul.timeline').html(data.html).promise().done(function(){
        $('div.loading').hide();
        });
        }
        });

    });
});

</script>
@stop