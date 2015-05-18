          {{ Form::open(array('url' => URL::route('honor.update' ,array('id' => $detail->id)) ,'method'=> 'put' , 'role' =>'form' , 'id'=> 'edit_detail')) }}

  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh Sữa Thông Tin Đoàn Viên </h4>
      </div>
      <div class="modal-body">



        <!-- Date range -->

                        <div class="form-group row" style="margin: 10px;">
                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                              {{Form::label('decision_no' , 'Số Quyết Định' , array('class'=>'col-xs-3 control-label align-right'))}}
                            <div class="col-xs-6">
                              {{Form::text('decision_no'  , $detail->decision_no, array('class' =>'form-control'))}}
                         </div>
                         </div>
                        <div class="form-group row" style="margin: 10px;">
                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                              {{Form::label('date' , 'Ngày ra Quyết Đinh' , array('class'=>'col-xs-3 control-label align-right'))}}
                            <div class="col-xs-6">
                              {{Form::text('date'  , isset($detail->date)? $detail->date->toDateString() : '', array('class' =>'form-control' , 'id'=>'date'))}}
                         </div>
                         </div>
                        <div class="form-group row" style="margin: 10px;">
                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                              {{Form::label('suggested' , 'Đơn vị Đề Nghị' , array('class'=>'col-xs-3 control-label align-right'))}}
                            <div class="col-xs-6">
                              {{Form::text('suggested'  , $detail->suggested, array('class' =>'form-control time_pick'))}}
                         </div>
                         </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </div>
           {{Form::close()}}