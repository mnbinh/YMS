@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
            {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}
           {{--<link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">--}}
           {{--<script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>--}}
           {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                        {{--<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>--}}
                         {{HTML::script('js/net/datatable-min.1.10.5.js')}}
                      {{--<script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>--}}
                         {{HTML::script('js/net/datatable.bootstrap.js')}}

                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản Lý Hoạt Động

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Quản Lý Hoạt Động</a></li>
                        <li class="active">Hoạt Động Chi Đoàn</li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Danh sách các chi đoàn</h3>
                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">
                                <!-- Render button-->
                                    <div class="row">
<div class="dropdown col-md-2">
      <a class="dropdown-toggle btn btn-flat btn-success btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
         Tác Vụ  <span class="caret"></span>
      </a>
                  <ul class="dropdown-menu">
                      <li role="presentation">

                      <a href="#" role="menuitem" tabindex="-1" class="add_member">In</a>
                      </li>

                      <li role="presentation">
           <a href="#" role="menuitem" tabindex="-1" class="excel_member">Thêm Từ File</a>

                      </li>




          </ul>
         </div>

                                    </div>

                                  <!-- Render table-->
                                   {{ $table->render() }}
                                   {{ $table->script() }}

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div>
                    </div>

    </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

$(document).on('ifToggled','input.check-multiple',function(event){
            var checkbox = $(this).parent();
            checkbox.hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');

               var aid = $(this).data('aid');
               var data = {
                            'activity_id' : aid} ;
               var url ;

                if($(this).prop('checked')){
                 url = "{{URL::route('confirm.activity')}}";

                 } else{
                url = "{{URL::route('del.confirm.activity')}}";

                 }
                        $.ajax({
                          type: "POST",
                          url: url ,
                          data: data,
                          success: function(data){
                             $('.fa-spin').remove();
                             checkbox.show();
                          },
                          dataType: 'json'
                        });

                });
$(document).on('click','a.detail' ,function(e){
e.preventDefault();
$.get($(this).prop('href')).done(function(data){
                                    $('div.modal-content').html(data['html']).promise().done(function(){
                                       $('#my-modal').modal('show');
                                    });
                                   });
});
});

</script>
@stop