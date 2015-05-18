          {{ Form::open(array('url' => URL::route('members.update' ,array('id' => $member->id)) ,'method'=> 'put' , 'role' =>'form' , 'id'=> 'add_core')) }}

  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh Sữa Thông Tin Đoàn Viên </h4>
      </div>
      <div class="modal-body">



                 {{Form::hidden('id'  , $member->id, array('class' =>'form-control' , 'id' => "edit-form" ))}}
        <!-- Date range -->

                        <div class="form-group row" style="margin: 10px;">
                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                              {{Form::label('first_name' , 'Họ' , array('class'=>'col-xs-3 control-label align-right'))}}
                            <div class="col-xs-6">
                              {{Form::text('first_name'  , $member->first_name, array('class' =>'form-control'))}}
                         </div>
                         </div>
                        <div class="form-group row" style="margin: 10px;">
                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                              {{Form::label('last_name' , 'Tên' , array('class'=>'col-xs-3 control-label align-right'))}}
                            <div class="col-xs-6">
                              {{Form::text('last_name'  , $member->last_name, array('class' =>'form-control'))}}
                         </div>
                         </div>
                        <div class="form-group row" style="margin: 10px;">
                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                              {{Form::label('date_of_bird' , 'Ngày sinh' , array('class'=>'col-xs-3 control-label align-right'))}}
                            <div class="col-xs-6">
                              {{Form::text('date_of_bird'  , $member->date_of_bird->toDateString(), array('class' =>'form-control time_pick'))}}
                         </div>
                         </div>
                         <div class="form-group row" style="margin: 10px;">
                                                                         {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                         {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                               {{Form::label('join_date' , 'Ngày vào đoàn' , array('class'=>'col-xs-3 control-label align-right '))}}
                             <div class="col-xs-6">
                               {{Form::text('join_date'  , $member->join_date->toDateString(), array('class' =>'form-control  time_pick' ))}}
                          </div>
                          </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </div>
           {{Form::close()}}