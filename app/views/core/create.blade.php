          {{ Form::open(array('url' => URL::route('core.store') ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_core')) }}

  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lập Danh Sách Lực Lương Nòng cốt </h4>
      </div>
      <div class="modal-body">


                                                  {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}

                                                 {{Form::hidden('semester_id'  , $sem->id )}}
                                                  {{Form::hidden('name'  , "Năm Học ".$sem->year." Học kỳ ". $sem->semester, array('class' =>'form-control' ))}}
        <!-- Date range -->
                                           <div class="form-group row"  style="margin-bottom: 10px">
                                     {{Form::label('date' , 'Thời hạn đề cữ:' ,array('class'=>'col-xs-3 control-label align-right'))}}
                                                <div class="col-xs-9">
                                               <div class="input-group">
                                                   <div class="input-group-addon">
                                                       <i class="fa fa-calendar"></i>
                                                   </div>
                                                   <input name='date' type="text" class="form-control pull-right" id="date"/>
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
                                                   <input name='expired_date' type="text" class="form-control pull-right" id="expired_date"/>
                                               </div><!-- /.input group -->
                                             </div>
                                           </div>
                                              <div class="form-group row"  style="margin-bottom: 10px">
                                                  {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                  {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                           {{Form::label('description' , 'Chi Tiết:' ,array('class'=>'col-xs-3 control-label align-right'))}}
                                                    <div class="col-xs-9">
                                                  {{Form::textarea('description'  , null, array('class' =>'form-control text-area' ))}}
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
        <button type="submit" class="btn btn-primary">Tạo</button>
      </div>
           {{Form::close()}}