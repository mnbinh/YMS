    <div class="fuelux">
        <div class="wizard" id="test">
    <ul class="steps">
        <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Chọn Sinh Viên<span class="chevron"></span></li>
        <li data-step="2"><span class="badge">2</span>Chi Tiết Khen Thưởng<span class="chevron"></span></li>
        {{--<li data-step="3" data-name="template"><span class="badge">3</span>Template<span class="chevron"></span></li>--}}
     </ul>

  <form id="orderForm" method="post" class="form-horizontal">
             <div class="step-content">
                 <!-- The first panel -->
                 <div class="step-pane active" data-step="1">
                     <div class="form-group" style="margin: 10px;">
                                                                                        {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                                        {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                              {{Form::label('member_id' , 'Chọn Đoàn viên :' ,array('class'=>'col-xs-3 control-label'))}}
                                              <div class="col-xs-6">
                                              <div class="input-group">
                                              {{Form::text('member_id'  , null, array('class' =>'form-control'))}}
                                              <span class="input-group-btn">
                                                   <button class="btn btn-info btn-flat" type="button"><i class="fa fa-search"></i></button>
                                              </span>
                                              </div>
                                              </div>
                     </div>




                 </div>

                 <!-- The second panel -->
                 <div class="step-pane" data-step="2">
                      <div class="form-group">
                                                                      {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                                      {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                            {{Form::label('suggested' , 'Đơn vị đề nghị')}}
                            {{Form::text('suggested'  , null, array('class' =>'form-control'))}}
                      </div>
                 </div>
             </div>

         </form>
      </div>
      </div>
 <div class="modal-footer">
       <button type="button" class="btn btn-flat btn-danger previous"><span class="fa fa-arrow-left"></span> Prev</button>
       <button type="button" class="btn btn-flat btn-info next" data-last="Complete">Next <span class="fa fa-arrow-right"></span></button>

      </div>