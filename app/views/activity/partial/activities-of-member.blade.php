<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hoạt Động Trong Học Hì {{$semester->semester}} / {{$semester->year}} của
        {{$member->first_name}} {{$member->last_name}}</h4>
 </div>
     <div class="modal-body">
     <div class="row">
     <div class="col-lg-3">
     {{Form::select('type' , array('school' => 'Hoạt Động Đoàn Khoa' , 'union' => 'Hoạt Động Chi Đoàn') , null ,
      array('class' => 'form-control' , 'id' => 'select_type' , 'data-id' => $member->id , 'data-sid' => $semester->id))}}
     </div>
     </div>
     <div class="row content">
     @foreach($school_activities as $activity)
     {{--@if(!in_array($activity->id , $sign_activities))--}}
     <div class="box box-solid">
                                     <div class="box-header">
                                         <h3 class="box-title text-red"><i class="fa fa-rocket"></i> {{$activity->name}}</h3>
                                         <div class="box-tools pull-right">

                                         </div>
                                     </div><!-- /.box-header -->
                                     <div class="box-body">
                                         <blockquote style="border-left: 5px solid #f56954; ">
                                             <p>{{$activity->description}}</p>
                                             <small>{{$activity->date->toDateString()}}</small>
                                                 <div class='pull-right'>

                   <a class="btn btn-info btn-xs btn-flat">Chi Tiết</a>
                        </div>
                                         </blockquote>

                                     </div><!-- /.box-body -->
      </div>
   {{--@endif--}}
@endforeach
</div>

    </div>
     <div class="modal-footer">


        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Đóng</button>
      </div>