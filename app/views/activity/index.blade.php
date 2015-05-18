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
                    <div class="row" style="margin-right: 30px; margin-bottom: 10px; margin-left: 5px">
         <div class="btn-group">
                                                                        <button class="active btn btn-warning btn-flat " href="#">Available</button>
                                                                        <button class="btn btn-warning btn-flat" href="#">Expired</button>
                                                                        <button class="btn btn-warning btn-flat" href="#">All</button>
         </div>
{{--{{link_to_route('activity.create' , 'Đăng Ký Hoạt Động' , array() , array('class'=>'btn btn-info btn-flat pull-right'))}}--}}
<div class="btn-group pull-right ">
            <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
               Đăng Ký Hoạt Động  <span class="caret"></span>
             </button>
                    <ul class="dropdown-menu">
                          <li>
                          {{link_to_route('activity.create' , 'Chi Đoàn' )}}
                          </li>

                          <li>
                          {{link_to_route('school.activity.get','Đoàn Khoa' , array() , array('class' => 'get-activities'))}}
                          </li>
                    </ul>
    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- The time line -->

                            <ul class="timeline">

                                @foreach($f_activities as $activity)
                                <li >

                                    <i class="fa {{$activity->confirm ? 'fa-bell  bg-blue' : 'fa-bell  bg-red'}}"></i>
                                    <div class="timeline-item">
                                    <?php
                                     $time = $activity->time;
                                    $difference = ($time->diff($now)->days < 1)
                                        ? 'today'
                                        : $time->diffForHumans();
                                    ?>
                                        <span class="time"><i class="fa fa-clock-o"></i> {{$difference}}</span>
                                        <h3 class="timeline-header">{{link_to_route('activity.show',$activity->name,array('acticity'=>$activity->id))}}({{$activity->place}}) </h3>
                                        <div class="timeline-body">
                                            {{$activity->description}}
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-primary btn-xs btn-flat">Read more</a>
                                            <a class="btn btn-danger btn-xs btn-flat">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                 <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                      {{date('d-m-Y')}}
                                    </span>
                                </li >
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                    @foreach($c_activities as $activity)
                                <li >

                                    <i class="fa {{$activity->confirm ? 'fa-bell  bg-blue' : 'fa-bell  bg-red'}}"></i>
                                    <div class="timeline-item">
                                    <?php
                                     $time = $activity->time;
                                    $difference = ($time->diff($now)->days < 1)
                                        ? 'today'
                                        : $time->diffForHumans();
                                    ?>
                                        <span class="time"><i class="fa fa-clock-o"></i> {{$difference}}</span>
                                        <h3 class="timeline-header">{{link_to_route('activity.show',$activity->name,array('acticity'=>$activity->id))}}({{$activity->place}}) </h3>
                                        <div class="timeline-body">
                                            {{$activity->description}}
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
    $('a.get-activities').click(function(e){
        e.preventDefault();
        var url = $(this).prop('href');

         $.get(url).done(function(data){
          $('div.modal-content').html(data['html']).promise().done(function(){
              $('#my-modal').modal('show');
          });
         });
    });
    $(document).on('click' ,'a.sign' , function(e){
    e.preventDefault();
    var btn = $(this);
    btn.prepend('<i class="fa fa-refresh fa-spin"></i> ');
//    btn.hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
    var activity_id = $(this).data('id');
    var data = {
    "activity_id" : activity_id
    }
    var url = "{{URL::route('attach.union')}}"
                            $.ajax({
                              type: "POST",
                              url: url ,
                              data: data,
                              success: function(data){
                              btn.parents('div.box').find('div.box-tools').html('<small class="badge pull-right bg-green">Đã Đăng Ký</small>');
                                btn.parent().append('<a class="btn btn-danger btn-xs btn-flat un_sign" data-id="'+activity_id+ '">Rút Đăng Ký</a>');
                                btn.remove()
                              },
                              dataType: 'json'
                            });
    });
      $(document).on('click' ,'a.un_sign' , function(e){
        e.preventDefault();
        var btn = $(this);
         btn.prepend('<i class="fa fa-refresh fa-spin"></i> ');
        var activity_id = $(this).data('id');
        var data = {
        "activity_id" : activity_id
        }
        var url = "{{URL::route('detach.union')}}"
                                $.ajax({
                                  type: "POST",
                                  url: url ,
                                  data: data,
                                  success: function(data){

                                  btn.parents('div.box').find('div.box-tools').html('');
                                    btn.parent().append('<a class="btn btn-success btn-xs btn-flat sign" data-id="'+activity_id+ '">Đăng Ký</a>');
                                    btn.remove()
                                  },
                                  dataType: 'json'
                                });
        });
});

</script>
@stop