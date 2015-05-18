@foreach($activities as $activity)
     {{--@if(!in_array($activity->id , $sign_activities))--}}
     <div class="box box-solid">
                                     <div class="box-header">
                                         <h3 class="box-title text-red"><i class="fa fa-rocket"></i> {{$activity->name}}</h3>
                                         <div class="box-tools pull-right">

                                         </div>
                                     </div><!-- /.box-header -->
                                     <div class="box-body">
                                         <blockquote style="border-left: 5px solid #f56954; ">
                                             <p>{{str_limit($activity->description , 100)}}</p>
                                             <small>{{isset($activity->date) ? $activity->date->toDateString() : $activity->time->toDateString()}}</small>
                                                 <div class='pull-right'>

                   <a class="btn btn-info btn-xs btn-flat">Chi Tiết</a>
                        </div>
                                         </blockquote>

                                     </div><!-- /.box-body -->
      </div>
   {{--@endif--}}
@endforeach
