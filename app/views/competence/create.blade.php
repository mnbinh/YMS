      {{ Form::open(array('route' => 'competence.store' ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_competence')) }}


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thêm Ban Chấp Hành Nhiệm Kỳ {{$prorogue->name}} </h4>
      </div>
      <div class="modal-body">

                                          <div class="box-body fuelux">


                        <div class="row" style="margin: 10px; text-align: right;">
                                {{Form::label('union_id' , 'Chi Đoàn :' , array('class'=>'col-xs-3 col-xs-offset-2 control-label' , 'id' =>'select_union'))}}
                              <div class="col-xs-6">
                                {{ Form::select('union_id', $unions, null, array('class' => 'form-control union')) }}
                              </div>
                        </div>
                      {{Form::hidden('prorogue_id',$prorogue->id)}}
                        <div class="row" style="margin: 10px; text-align: right;">
                                {{Form::label('student_id' , 'Chọn Đoàn Viên :' , array('class'=>'col-xs-3 col-xs-offset-2 control-label'))}}
                              <div class="col-xs-6">
                                {{ Form::text('student_id', null, array('class' => 'form-control' , 'id'=> 'auto-find')) }}
                              </div>
                        </div>
                        <div class="row" style="margin: 10px; text-align: right;">
                                {{Form::label('competence_id' , 'Chức vụ :' , array('class'=>'col-xs-3 col-xs-offset-2 control-label'))}}
                              <div class="col-xs-6">
                                {{ Form::select('competence_id', $competences, null, array('class' => 'form-control')) }}
                              </div>
                        </div>

                                          </div><!-- /.box-body -->

                                          {{--<div class="box-footer">--}}
                                              {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                          {{--</div>--}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat">Thêm</button>
      </div>
                {{Form::close()}}