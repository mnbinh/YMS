  @foreach($periods as $period)

     <div class="col-xs-12">

         <div class="box ">

                                     <div class="box-header">
                                        <i class="fa fa-gift fa-lg red"></i>
                                    <h3 class="box-title">
                     {{link_to_route('show.list-honor',$period->name, array('id' =>$period->id), array('class' => 'btn-link'))}}
                                    </h3>

                                     </div><!-- /.box-header -->
                                     <div class="box-body">

                                     <div class="callout callout-info">


                                        Trạng Thái :
                                           @if($period->end_date->gte(\Carbon\Carbon::now()))
                                        <small class="label  bg-blue">Tiến cữ</small>
                                        @elseif($period->expired_date->gte(\Carbon\Carbon::now()))
                                         <small class="label  bg-yellow">Xét Duyệt</small>
                                        @else
                                         <small class="label  bg-red">Hết Hạn</small>
                                        @endif
                                        <div>{{$period->description}}</div>
                                       </div>
                                     </div><!-- /.box-body -->
                                     <div class="box-footer">

                                     <div class="pull-right">
                           @if($period->expired_date->gte(\Carbon\Carbon::now()))
                          {{link_to_route('show.admin.period','Chi Tiết', array('id' => $period->id), array('class' => 'btn btn-info btn-xs btn-flat detail'))}}
                           {{link_to_route('edit.admin.period','Chỉnh sữa', array('id' => $period->id), array('class' => 'btn btn-warning btn-xs btn-flat edit'))}}
                           {{link_to_route('destroy.admin.period','Xóa', array('id' => $period->id), array('class' => 'btn btn-danger btn-xs btn-flat delete'))}}
                           @else
                            {{link_to_route('honor.admin','Danh sách', array('period_id' => $period->id), array('class' => 'btn btn-warning btn-xs btn-flat edit'))}}
                           @endif
                                    </div>
                                    <div class="clearfix"></div>

                                     </div>
         </div><!-- /.box -->

     </div>


@endforeach