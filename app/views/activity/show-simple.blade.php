


<div class="box box-solid">
                                <div class="box-header" >
                                    <h3 class="box-title">{{$activity->name}}</h3>
                                   <div class="box-tools pull-right">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                  {{--<button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-6">
                                      <dl class="dl-horizontal">
                                        <dt class="text-muted"><b>Tình trạng:</b></dt>
                                        @if($activity->confirm)
                                        <dd><div class="label bg-green">
                                        Duyệt

                                        </div></dd>
                                        @else
                                        <dd><div class="label bg-red">
                                        Chờ Duyệt

                                        </div></dd>
                                        @endif
                                      </dl>
                                      </div>
                                    </div>
                                       <div class="row" style="margin-bottom: 10px">
                                         <div class="col-md-6">
                                               <dl class="dl-horizontal">
                                             <dt class="text-muted"><b>Thời gian:</b></dt>
                                              <dd>{{$activity->time->toDateString()}}</dd>
                                             <dt class="text-muted"><b>Địa Điểm:</b></dt>
                                              <dd>Cần Thơ</dd>
                                             <dt class="text-muted"><b>Học Kỳ:</b></dt>
                                              <dd>{{'Học kỳ ' .$activity->semester->semester .'/'.$activity->semester->year  }}</dd>
                                                 </dl>
                                         </div>
                                         <div class="col-md-6">
                                               <dl class="dl-horizontal">
                                             <dt class="text-muted"><b>Ngày tạo:</b></dt>
                                              <dd>{{$activity->created_at->toDateString()}}</dd>
                                                 <dt class="text-muted"><b>Chi Đoàn:</b></dt>
                                                 <dd>{{$activity->youthUnion->name}}</dd>

                                                <dt class="text-muted"><b>Số lượng Đoàn viên:</b></dt>
                                                <dd><div class="label bg-green">
                                                {{$activity->youthMembers->count()}}
                                                </div>
                                                </dd>
                                                 </dl>
                                         </div>



                                       </div>
                                      <div class="row" style="margin-bottom: 10px">
                                    <div class="col-md-12">
                                      <dl class="dl-horizontal">
                                      <dt class="text-muted"><b>Chi Tiết:</b></dt>
                                      <dd>{{$activity->description}}</dd>
                                      </dl>
                                      </div>
                                    </div>
                            </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
