
    <div class="fuelux">
        <div class="wizard" id="test">
    <ul class="steps">
        <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Chọn Sinh Viên<span class="chevron"></span></li>
        <li data-step="2"><span class="badge">2</span>Chi Tiết Khen Thưởng<span class="chevron"></span></li>
        {{--<li data-step="3" data-name="template"><span class="badge">3</span>Template<span class="chevron"></span></li>--}}
     </ul>




  {{Form::open(array('url'=> URL::route('store.single.admin') , 'class' => 'form-horizontal' , 'id' => 'addForm'))}}
             <div class="step-content">
                 <!-- The first panel -->
                 <div class="step-pane active" data-step="1">
                     <div class="form-group member-id" style="margin: 10px;">
                                                {{Form::hidden('period_id' ,$period_id , array('id' => 'period_id'))}}
                                          {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                              {{Form::label('member_id' , 'Chọn Đoàn viên :' ,array('class'=>'col-xs-3 control-label'))}}
                                              <div class="col-xs-6">
                                              <div class="input-group">
                                              {{Form::text('member_id'  , null, array('class' =>'form-control' ,'id' =>'member_id'))}}
                                              <span class="input-group-btn">
                                                   <button class="btn btn-info btn-flat find-member" type="button"><i class="fa fa-search"></i></button>
                                              </span>
                                              </div>
                                              </div>

                     </div>




                 </div>

                 <!-- The second panel -->
                 <div class="step-pane" data-step="2">
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('bonus_id' , 'Loại' , array('class'=>'col-xs-3 control-label'))}}
                              <div class="col-xs-6">
                            {{ Form::select('bonus_id', $type, null, array('class' => 'form-control')) }}
                        </div>
                        </div>
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('suggested' , 'Đơn vị đề nghị' , array('class'=>'col-xs-3 control-label'))}}
                          <div class="col-xs-6">
                            {{Form::text('suggested'  , null, array('class' =>'form-control'))}}
                       </div>
                       </div>
                      <div class="form-group" style="margin: 10px;">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('detail' , 'Chi tiết' , array('class'=>'col-xs-3 control-label'))}}
                              <div class="col-xs-6">
                            {{Form::textarea('detail'  , null, array('class' =>'form-control'))}}
                        </div>
                      </div>

                 </div>

             </div>

       {{Form::close()}}

      </div>
      </div>
         <div class="modal-footer">
                                                             <button type="button" class="btn btn-flat btn-danger previous"><span class="fa fa-arrow-left"></span> Prev</button>
                                                             <button type="button" class="btn btn-flat btn-info next" data-last="Complete">Next <span class="fa fa-arrow-right"></span></button>
         </div>
