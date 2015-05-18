  {{ Form::open(array('route' => 'members.store.excel' , 'files' => true)) }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Thêm Đoàn Viên Từ File Ecxel </h4>
        </div>
        <div class="modal-body">
{{Form::hidden('union_id' , $union_id)}}
                                            <div class="box-body">

                                                 <div class="form-group">
                                                      {{Form::file('excel')}}
                                                  </div>

                                            </div><!-- /.box-body -->

                                            {{--<div class="box-footer">--}}
                                                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                            {{--</div>--}}

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tạo Mới</button>
        </div>


   {{ Form::close() }}