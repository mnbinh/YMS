  @foreach($periods as $period)
        <div class="row">
     <div class="col-xs-12">

         <div class="box ">

                                     <div class="box-header">
                                        <i class="fa fa-gift fa-lg red"></i>
                                    <h3 class="box-title">
                     {{link_to_route('show.list-honor',$period->name, array('id' =>$period->id), array('class' => 'btn-link'))}}
                                    </h3>
                                    <div class="box-tools pull-right">

                                    </div>
                                     </div><!-- /.box-header -->
                                     <div class="box-body">

                                     <div class="callout callout-info">
                                     Trạng Thái:
                                      @if($period->end_date->gte(\Carbon\Carbon::now()))
                                     <span class="label bg-blue">Tiến cữ</span>
                                      @elseif($period->expired_date->gte(\Carbon\Carbon::now()))
                                       <span class="label bg-yellow">Xét Duyệt</span>
                                      @else
                                        <span class="label bg-red">Chính thức</span>
                                      @endif




                                      <p>{{$period->description}}</p>
                                       </div>
                                     </div><!-- /.box-body -->
                                     <div class="box-footer">

                                     <div class="pull-left">


                                    @if($period->expired_date->gte(\Carbon\Carbon::now()))
                                     {{link_to_route('show.list-honor','Danh Sách Tiến Cũ', array('id' => $period->id), array('class' => 'btn btn-success btn-xs btn-flat '))}}

                                    @else
                                       {{link_to_route('show.list-honor','Danh sách', array('id' => $period->id), array('class' => 'btn btn-warning btn-xs btn-flat detail'))}}

                                     @endif
                                    </div>
                                    <div class="clearfix"></div>

                                     </div>
         </div><!-- /.box -->

     </div>
  </div>

@endforeach