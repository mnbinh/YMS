@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
           <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
                   {{HTML::script('js/net/jquery-ui.min.js')}}
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>

           <style type="text/css">
          .timeline > li.time-label > span {border-radius: 0px; -webkit-border-radius: 0px;}
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
                        Danh Sách Ban Chấp Hành Chi Đoàn

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">
 <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->


                              <div class="box-body ">
                              <div class='fuelux row' style="margin-bottom: 10px">
      <div class="dropdown col-md-2">
      <a class="dropdown-toggle btn btn-flat btn-success btn-sm " data-toggle="dropdown" href="#" style="color: #fff;">
         Tác Vụ  <span class="caret"></span>
      </a>
                  <ul class="dropdown-menu">
                      <li role="presentation">

                      <a  href="{{URL::route('competence.create', array('prorogue_id'=> $prorogue->id ))}}" role="menuitem" tabindex="-1" href="" class="add" >Thêm</a>
                      </li>

                      <li role="presentation">
           <a href="#" role="menuitem" tabindex="-1" href="" class="excel_member" >Thêm Từ File</a>

                      </li>




          </ul>
         </div>
  <div class="col-md-6 col-md-offset-1 contain-select" style="text-align: center">
  <span class="inline">Chi Đoàn:</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="union">

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($unions as $union)
    <li data-value="{{$union->id}}"><a href="#">{{$union->name}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="union" readonly="readonly" aria-hidden="true" type="text"/>
</div>

<span class="inline">Nhiệm Kỳ:</span>
<div class="btn-group selectlist distance " data-resize="auto" data-initialize="selectlist" id="prorogue" >

  <button class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" type="button">
    <span class="selected-label"></span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">

@foreach ($prorogues as $pro)
    <li data-value="{{$pro->id}}"><a href="#">{{$pro->name}}</a></li>
@endforeach

  </ul>
  <input class="hidden hidden-field" name="prorogue" readonly="readonly" aria-hidden="true" type="text"/>
</div>
<div class="clearfix">
</div>



</div>

                                </div>



                                   {{ $table->render() }}
                                   {{ $table->script() }}
                                  <div class="clearfix"></div>
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
</div>
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
 $('#union').selectlist();
 $('#prorogue').selectlist();
  $('#prorogue').selectlist('selectByValue', '{{$prorogue->id}}');
  $('#union').selectlist('selectByValue', '{{$union_id}}');
 $(document).on('changed.fu.selectlist','#union' , function (event, data) {
reloadTable(data.value ,$('#prorogue').selectlist('selectedItem').value )
 });
  $(document).on('changed.fu.selectlist','#prorogue' , function (event, data) {

  var link = "{{URL::route('competence.create')}}"+"?prorogue_id="+data.value;
  $('a.add').prop('href', link);
reloadTable( $('#union').selectlist('selectedItem').value , data.value);
  });

  function reloadTable(union_id , prorogue_id)
  {
  var url = "{{URL::route('admin.data.competence')}}" +"?union_id="+union_id+"&prorogue_id="+prorogue_id;
     oTable.ajax.url(url).load();
  }

     $('a.add').click(function(e){
         e.preventDefault();
         var url = $(this).prop('href');

          $.get(url).done(function(data){
          if(data.avail){
           $('div.modal-content').html(data['html']).promise().done(function(){
              $('select.union').val($('#union').selectlist('selectedItem').value)
               $('#my-modal').modal('show');
           });
           }
           else
           {
           showAlert('danger','Have Problem' , 'Nhiệm kỳ đã quá hạn không thể thêm thành viên!');
           }
          });
     });
     var options = {
         source: "{{URL::route('competence.data.member' )}}",
         minLength: 2,
         appendTo : "#add_competence"

     };

     var selector = '#auto-find';

      $(document).on('keydown.autocomplete', selector, function() {
          var uid = $('select.union').val();
          $(this).autocomplete({
           source:  function(request, response) {
                                         $.ajax({
                                             url: "{{URL::route('competence.data.member' )}}",
                                             dataType: "json",
                                             data: {
                                                 term: request.term,
                                                 union_id: uid
                                             },
                                             success: function(data) {
                                                 response(data);
                                             }
                                         });
                                     } ,
                      select: function (event, ui) {
                                          $("#auto-find").val(ui.item.value);
                                          return false;
                                      } ,
                     appendTo : "#add_competence"

          }).data("ui-autocomplete")._renderItem = function (ul, item) {
                                 return $("<li>")
                                     .data("item.autocomplete", item)
                                     .append("<a>" + item.label + "<br>" + item.union + "</a>")
                                     .appendTo(ul);
                             };;
      });
      $(document).on('change' , '#select_union' , function(){
     options.source = "{{URL::route('competence.data.member' )}}"+"?union_id="+$(this).val();
     alert(options.source);
      });

});

</script>
@stop