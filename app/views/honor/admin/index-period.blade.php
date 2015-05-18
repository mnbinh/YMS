@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
                 <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
           <style type="text/css">
           .ui-autocomplete { z-index: 5000;}
           </style>
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
             <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
             <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>

                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Quản lý Khen Thưởng

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Đợt Khen Thưởng</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<div class="box box-solid ">
<div class="box-header">
                                    <h3 class="box-title">Các Đợt Khen Thưởng</h3>

                                </div>
   <div class="box-body contain-period">

<div class="col-md-2">
 {{link_to_route('honor.create','Thêm', array(), array('class' => 'btn btn-info btn-flat add'))}}
</div>
   <div class="col-md-4 col-md-offset-2 " style="margin-bottom: 20px">
 {{Form::select('type' , array('available' => 'Các Đợt Khen Thưởng Mới' ,'expired' =>'Các Đợt Khen Thưởng Đã Qua') , null , array('class'=>'form-control type'))}}

                                  </div>


        <div class="row contain">
        @include('honor.partial.type-period', array('periods' => $periods))
  </div>
</div>
</div>

    </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

 $('a.add').click(function(e){
    e.preventDefault();
 $.get($(this).prop('href')).done(function(data){
                                    $('div.modal-content').html(data['html']).promise().done(function(){
                                        $('#date').daterangepicker({
                                        format: 'YYYY-MM-DD'
                                        });
                                        $('#expired_date').daterangepicker({
                                         showDropdowns: true ,
                                         format: 'YYYY-MM-DD' ,
                                          singleDatePicker: true
                                        });
                                        $( '.text-area').wysihtml5();
                                       $('#my-modal').modal('show');
                                    });
                                   });
 });
 $(document).on("submit" ,"#add_period",function(e){
       e.preventDefault();
       var drp = $('#date').data('daterangepicker');
        var data ={
        'begin_date' : drp.startDate.format('YYYY-MM-DD') ,
        'end_date' : drp.endDate.format('YYYY-MM-DD'),
        'expired_date': $('#expired_date').val(),
         'name' :  $('input[name="name"]').val() ,
         '_token' : $('input[name="_token"]').val() ,
         'description' : $('textarea[name="description"]').val()
        }


        $.post(
                $( this ).prop( 'action' ),
               data
                ,
                function( data ) {
                    //do something with data/response returned by server
                    if(data.status == 'success'){
                     $('.contain').append(data.html);
                    $('#my-modal').modal('hide');

                    }
                },
                'json'
            );

    });

    $('select.type').change(function(){
    $('div.loading').show();
        var type = $(this).val();
var url = '{{URL::route('index.admin.period')}}' + "?type="+type ;
        $.get(url).done(function(data){

           $('div.contain').html(data.html);
               $('div.loading').hide();

        })

    });
   $(document).on('click', 'a.edit' , function(e){
    e.preventDefault();
    var url = $(this).prop('href');
    $.get(url).done(function(data){
    $('div.modal-content').html(data.html).promise().done(function(){
        $('#date').daterangepicker({
        format: 'YYYY-MM-DD'
        });
        $('#expired_date').daterangepicker({
         showDropdowns: true ,
         format: 'YYYY-MM-DD' ,
          singleDatePicker: true
        });
          $(".text-area").wysihtml5();
    });

    $('#my-modal').modal('show');
    });
   });

});

</script>
@stop