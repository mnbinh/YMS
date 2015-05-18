    {{ Form::open(array('route' => array('activity.update' , $activity->id) ,'method'=> 'PUT' , 'role' =>'form' , 'id'=> 'edit_activity')) }}
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cập nhật hoạt đọng </h4>
    </div>
     <div class="modal-body">

{{Form::hidden('youth_union_id' ,Confide::user()->youthMember->youthUnion->id , array())}}
     {{Form::hidden('semester_id'  , 5, array())}}

                                        <div class="form-group row">

                                            {{Form::label('name' , 'Tiêu Đề:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-7">
                                            {{Form::text('name'  , $activity->name, array('class' =>'form-control' ))}}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            {{Form::label('place' , 'Địa Điểm:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-7">
                                            {{Form::text('place'  , $activity->place, array('class' =>'form-control' ))}}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            {{Form::label('time' , 'Thời gian:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-7">
                                            {{Form::text('time'  , $activity->time, array('class' =>'form-control' ,'id' => 'time_pick'))}}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            {{Form::label('description' , 'Mô tả hoạt động:' ,array('class'=>'col-md-3 control-label'))}}
                                            <div class="col-md-7">
                                            {{Form::textarea('description'  , $activity->description, array('class' =>'form-control' ))}}
                                            </div>
                                        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </div>

         {{Form::close()}}
