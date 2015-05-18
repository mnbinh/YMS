      {{ Form::open(array('route' => 'fee.store' ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_fee')) }}


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tạo Mức Đoàn Phí </h4>
      </div>
      <div class="modal-body">

                                          <div class="box-body fuelux">


                        <div class="row" style="margin: 10px; text-align: right;">
                                {{Form::label('year_id' , 'Năm :' , array('class'=>'col-xs-3 col-xs-offset-2 control-label'))}}
                              <div class="col-xs-3">
                                {{ Form::select('year_id', $year, null, array('class' => 'form-control')) }}
                              </div>
                        </div>
                        @foreach($types as $type)
                        <div class="row" style="margin: 10px; text-align: right;">
                                {{Form::label( $type->id , $type->name.':' , array('class'=>'col-xs-3 col-xs-offset-2 control-label'))}}
                              <div class="col-xs-3">
                               <div class="spinbox" id="svSpinBox">
                                 <input name="{{$type->id}}" type="text" class="form-control input-mini spinbox-input">
                                 <div class="spinbox-buttons btn-group btn-group-vertical">
                                   <button type="button" class="btn btn-default spinbox-up btn-xs">
                                     <span class="glyphicon glyphicon-chevron-up"></span><span class="sr-only">Increase</span>
                                   </button>
                                   <button type="button" class="btn btn-default spinbox-down btn-xs">
                                     <span class="glyphicon glyphicon-chevron-down"></span><span class="sr-only">Decrease</span>
                                   </button>
                                 </div>
                               </div>
                              </div>
                        </div>
                        @endforeach

                                          </div><!-- /.box-body -->

                                          {{--<div class="box-footer">--}}
                                              {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                          {{--</div>--}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat">Tạo Mới</button>
      </div>
                {{Form::close()}}