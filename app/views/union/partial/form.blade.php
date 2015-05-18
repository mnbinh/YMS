      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ $header}} </h4>
      </div>
      <div class="modal-body">

                                          <div class="box-body">
                                           @if (isset($import))
                                               <div class="form-group">
                                                    {{Form::file('excel')}}
                                                </div>
                                           @elseif(isset($secretary))
                                              <div class="form-group">
                                                  {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                  {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                                  {{Form::label('student_id' , 'Mã Sinh Viên')}}
                                                  {{Form::text('student_id'  , null, array('class' =>'form-control' ))}}
                                              </div>
                                           @else
                                              <div class="form-group">
                                                  {{--<label for="exampleInputEmail1">Mã Chi Đoàn</label>--}}
                                                  {{--<input type="text" class="form-control" name="union_id" placeholder="Ví dụ: KH11Y1A1">--}}
                                                  {{Form::label('union_id' , 'Mã Chi Đoàn')}}
                                                  {{Form::text('union_id'  , null, array('class' =>'form-control' , 'placeholder' => 'Ví dụ: KH11Y1A1'))}}
                                              </div>
                                              <div class="form-group">
                                                  {{--<label for="exampleInputPassword1">Tên Chi Đoàn</label>--}}
                                                  {{--<input type="text" class="form-control" name="name" placeholder="Ví dụ: Tin Học Ứng Dụng K37 ">--}}
                                                   {{Form::label('name' , 'Tên Chi Đoàn')}}
                                                  {{Form::text('name'  ,null, array('class' =>'form-control' , 'placeholder' => 'Ví dụ: Tin Học Ứng Dụng K37'))}}
                                              </div>
                                              <div class="checkbox">
                                                  <label>
                                                      <input type="checkbox" id="check_file"> Chi Đoàn quá hạn
                                                  </label>
                                              </div>
                                          @endif

                                          </div><!-- /.box-body -->

                                          {{--<div class="box-footer">--}}
                                              {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                          {{--</div>--}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">{{isset($buttonText) ? $buttonText : 'Tạo Mới'}}</button>
      </div>