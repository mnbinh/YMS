      {{ Form::open(array('route' => 'admin.union.pay' ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_fee')) }}


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tạo Mức Đoàn Phí </h4>
      </div>
      <div class="modal-body">

                                          <div class="box-body fuelux">


                        <div class="row" style="margin: 10px; text-align: right;">
                                {{Form::label('union_id' , 'Chi Đoàn:' , array('class'=>'col-xs-3 col-xs-offset-2 control-label'))}}
                              <div class="col-xs-6">
                                {{ Form::select('union_id', $unions, null, array('class' => 'form-control select' , 'data-yid' => $yid )) }}
                              </div>
                        </div>

                        <div class="row table-fee" style="margin: 10px; text-align: right; ">
                            @include('fee.partial.table',array( 'pays' => $pays , 'uid' => $uid ,'yid' => $yid ,'count' => $count , 'monthFees' =>$monthFees))
                        </div>


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