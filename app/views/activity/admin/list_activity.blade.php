<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hoạt Động Đoàn Khoa</h4>
 </div>
     <div class="modal-body">
     @foreach($activities as $activity)
     {{--@if(!in_array($activity->id , $sign_activities))--}}
     <div class="box box-solid">
                                     <div class="box-header">
                                         <h3 class="box-title text-red"><i class="fa fa-rocket"></i> {{$activity->name}}</h3>
                                         <div class="box-tools pull-right">
                                         @if(!in_array($activity->id , $sign_activities))

                                         @else
                                         <small class="badge pull-right bg-green">Đã Đăng Ký</small>
                                         @endif
                                         </div>
                                     </div><!-- /.box-header -->
                                     <div class="box-body">
                                         <blockquote style="border-left: 5px solid #f56954; ">
                                             <p>{{$activity->description}}</p>
                                             <small>{{$activity->date->toDateString()}}</small>
                                                 <div class='pull-right'>
                                      @if(!in_array($activity->id , $sign_activities))
                        <span>   <a class="btn btn-success btn-xs btn-flat sign" data-id="{{$activity->id}}">Đăng Ký</a> </span>
                                      @else
                          <span><a class="btn btn-danger btn-xs btn-flat un_sign" data-id="{{$activity->id}}">Rút Đăng Ký</a></span>
                                      @endif
                   <a class="btn btn-info btn-xs btn-flat">Chi Tiết</a>
                        </div>
                                         </blockquote>

                                     </div><!-- /.box-body -->
      </div>
   {{--@endif--}}
@endforeach

    </div>
     <div class="modal-footer">


        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Đóng</button>
      </div>