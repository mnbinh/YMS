          {{ Form::open(array('url' => URL::route('update.admin.period' ,array('id' => $period->id)) ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_core')) }}

  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh Sữa Đợt Khen Thuỏng</h4>
      </div>
      <div class="modal-body">


                                              <div class="form-group row"  style="margin-bottom: 10px">
                                                  {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                  {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                                  {{Form::label('name' , 'Tên gọi:' ,array('class'=>'col-xs-3 control-label align-right'))}}
                                                   <div class="col-xs-9">
                                                  {{Form::text('name'  , $period->name, array('class' =>'form-control' ))}}
                                                  </div>
                                              </div>
        <!-- Date range -->
                                           <div class="form-group row"  style="margin-bottom: 10px">
                                                  {{Form::label('date' , 'Thời hạn đề cữ:' ,array('class'=>'col-xs-3 control-label align-right'))}}
                                                <div class="col-xs-9">
                                               <div class="input-group">
                                                   <div class="input-group-addon">
                                                       <i class="fa fa-calendar"></i>
                                                   </div>
                                                   <input name='date' value="{{$period->begin_date->toDateString().' - '.$period->end_date->toDateString()}}" type="text" class="form-control pull-right" id="date"/>
                                               </div><!-- /.input group -->
                                           </div>
                                           </div>
                                        <div class="form-group row"  style="margin-bottom: 10px">
                                              {{Form::label('expired_date' , 'Kết Thúc:' ,array('class'=>'col-xs-3 control-label align-right'))}}
                                                 <div class="col-xs-9">
                                               <div class="input-group">
                                                   <div class="input-group-addon">
                                                       <i class="fa fa-calendar"></i>
                                                   </div>
                                                   <input name='expired_date' value="{{$period->expired_date->toDateString()}}" type="text" class="form-control pull-right" id="expired_date"/>
                                               </div><!-- /.input group -->
                                             </div>
                                           </div>
                                              <div class="form-group row"  style="margin-bottom: 10px">
                                                  {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                  {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                                {{Form::label('description' , 'Chi Tiết:' ,array('class'=>'col-xs-3 control-label align-right'))}}
                                                    <div class="col-xs-9">
                                                  {{Form::textarea('description'  , $period->description, array('class' =>'form-control text-area' ))}}
                                              </div>
                                              </div>


<!-- /.form gro


                                          </div><!-- /.box-body -->

                                          {{--<div class="box-footer">--}}
                                              {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                          {{--</div>--}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
      </div>
      {{Form::close()}}