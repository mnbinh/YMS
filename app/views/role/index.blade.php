@extends('layout.master')

@section('styles')
             {{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
               {{ HTML::style('css/iCheck/minimal/red.css') }}
{{--               {{HTML::style('css/tree/bootstrap-combined.min.css')}}--}}
              <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
           <link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
           <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
           <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
           <style type="text/css">
          .timeline > li.time-label > span {border-radius: 0px; -webkit-border-radius: 0px;}
           </style>
{{--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.4/css/jquery.dataTables.min.css">--}}
                      {{--<script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>--}}
             <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
             <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
             <style type="text/css">
               .box {border-radius: 0px;
                     -webkit-border-radius: 0px;   }
               .control-label {
                 padding-top: 7px;
                 margin-bottom: 0;
                 text-align: right;
               }
               </style>

                                     <!-- AdminLTE App -->

@stop

@section('content')
 <section class="content-header">
                    <h1>
                        Phân Quyền

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::route('root')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Phân Quyền</li>
                    </ol>
  </section>

                <!-- Main content -->
   <section class="content">
<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Manage Role</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Assign Role</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Permission</a></li>

                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab_3">
                                 <div class="tree well" style="max-height: 100%; border: none; background-color: #ffffff; box-shadow: none">
                                     <ul>
                                            @foreach($groups as $group)
                                         <li>
                                             <span class="badge badge-info test"><i class="icon-plus-sign"></i> {{$group->name}}</span>
                                             <ul>
                                             @foreach($group->permissions as $perm)
                                                 <li>
                                                <a href="#" class="add"><span class="badge badge-success"><i class="fa fa-wrench"></i> {{$perm->display_name}}</span></a>

                                                 </li>

                                              @endforeach
                                             </ul>
                                          </li>
                                             @endforeach
                                             </ul>
                                                 </div>
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane active row " id="tab_1">

                        <div class="col-xs-8">
                                    <div style="margin-bottom: 5px">

                                       {{link_to_route('role.create','Create Your Own Role', array(), array('class' => 'btn btn-flat btn-info add'))}}


                                    </div>

                              <div class="">



<table id="list_role" class="table table-bordered">

    <thead>
    <tr>
                <th align="center" valign="middle" class="head1">Role</th>
                <th align="center" valign="middle" class="head2">Description</th>
                <th align="center" valign="middle" class="head8">Details</th>
            </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
                <tr>
                    <td align="center" valign="middle" class="head1">{{ $role->name }}</td>
                    <td align="left" valign="middle" class="head2">{{$role->description}}</td>
                    <td align="left" valign="middle" class="head8">

                    <a href="{{URL::route('role.show' ,array('id'=>$role->id))}}" class="btn btn-flat btn-info btn-xs edit">
                        <i class="fa fa-edit"></i>
                    </a>
                       <a href="{{URL::route('role.destroy' ,array('id'=>$role->id))}}" class="btn btn-flat btn-danger btn-xs destroy">
                                            <i class="fa fa-close"></i>
                        </a>
                    </td>
                </tr>
    @endforeach
   </tbody>
</table>
     </div><!-- /.box-body -->

</div>
                                    </div><!-- /.tab-pane -->
        <div class="tab-pane row" id="tab_2">
        <div class="col-xs-12">
                                            <div class="box">
                                                                <div class="box-header">
                                                                    <h3 class="box-title"></h3>
                                                                </div><!-- /.box-header -->


                                                              <div class="box-body ">
                                      <div class="row" >
                                      <div class="col-md-4 col-md-offset-4 ">
                                      <div class="distance">
                                  {{Form::select('type', array('default' => 'Tất Cả', 'school' => 'Ban Chấp Hành Khoa' ,
                                                  'class' => 'Ban Chấp Hành Chi Đoàn'),null,array('class' => 'form-control' , 'id'=>'choose_type'))}}
</div>
<div class="distance">
                         {{Form::select('type', $unions,null,array('class' => 'form-control' ,'id'=> 'choose_union'))}}
                               </div>
                               </div>
                               </div>

                                   <div class="">
                                {{ $table->render() }}
                              {{ $table->script() }}
                              <div class="clearfix"></div>
             </div><!-- /.box-body -->

        </div>

        </div>
        </div>
        </div>
                                </div><!-- /.tab-content -->
                            </div>




    </section><!-- /.content -->





@stop

@section('modal')
<div class="modal" id="my-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xac nhan</h4>
      </div>
      <div class="modal-body">
      <p>Ban co chac chan muon xia</p>

      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="button" class="btn btn-primary">Yes</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal" id="ajax-modal">
  <div class="modal-dialog ">
    <div class="modal-content">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');

	$('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').
	on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(':visible')) {
    		children.hide('fast');
    		$(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        }
        else {
    		children.show('fast');
    		$(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
    $(".test").parent('li.parent_li').find(' > ul > li').hide();
//    $(document).on('click' ,'a.add' , function(e){
//       e.preventDefault();
//       var html = '<li> <a href="#" class="add"><span class="badge badge-success"><i class="fa fa-wrench"></i> Add</span></a></li>' ;
//       $(this).parents('ul').append(html);
//    });
//    $('#list_role').dataTable();
    $('a.edit').click(function(e){
        e.preventDefault();
        var url = $(this).prop('href');

         $.get(url).done(function(data){
          $('#tab_1').html(data['html']);


         });
    });
        $('a.add').click(function(e){
            e.preventDefault();
            var url = $(this).prop('href');

             $.get(url).done(function(data){
              $('#tab_1').html(data['html']);


             });
        });

        $('a.destroy').click(function(e){
                e.preventDefault();
                $('#my-modal').modal('show');
//                       $.ajax({
//                            type: "DELETE",
//                            url: $(this).prop('href'),
//                            success: function(data) {
//                                //if something was deleted, we redirect the user to the users page, and automatically the user that he deleted will disappear
//                                if (data['message']  == 'success')
//                                alert('delete sucess');
//                            }
//                        });
        });

        $('#choose_type').change(function(){
     var type = $('#choose_type').val();
       var union_id = $('#choose_union').val();
     var url = '{{URL::route('admin.data.members')}}' +'?type=' + type +'&union_id='+union_id ;
       oTable.ajax.url(url).load();
        });
     $('#choose_union').change(function(){
      var type = $('#choose_type').val();
     var union_id = $('#choose_union').val();
      var url = '{{URL::route('admin.data.members')}}' +'?type=' + type +'&union_id='+union_id ;
        oTable.ajax.url(url).load();

        });
     $(document).on('click', 'a.detail' , function(e){
     e.preventDefault();
      $.get($(this).prop('href')).done(function(data){
       $('#ajax-modal .modal-content').html(data['html']).promise().done(function(){
        $("input[type=checkbox]").iCheck({checkboxClass: "icheckbox_minimal-red"});
          $('#ajax-modal').modal('show');
       });
      });
     });
$(document).on("submit" ,"#edit_user_role",function(e){
      e.preventDefault();
       $.post(
               $( this ).prop( 'action' ),
               $(this).serialize()
               ,
               function( data ) {
                   //do something with data/response returned by server
                   if(data.msg == 'success'){
                   $('#ajax-modal').modal('hide');
                   oTable.ajax.reload();
                   }
               },
               'json'
           );

   });


});

</script>
@stop