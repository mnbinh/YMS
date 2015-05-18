<div class="col-xs-12">
<div class ='box'>
        {{Form::open(array('route'=> 'role.store' ,'method'=> 'POST' , 'role' =>'form' , 'id'=> 'add_role'))}}

  <div class="box-header">
     <h3 class="box-title">Create Your Own Role</h3>

                                </div><!-- /.box-header -->
        <div class="box-body ">
            <div class="form-group row" style="text-align: right">

               {{Form::label('name' , 'Name:' ,array('class'=>'col-md-1 control-label'))}}
               <div class="col-md-5">
               {{Form::text('name'  , null, array('class' =>'form-control' ))}}
               </div>
           </div>
                            <table class="table">

        @foreach($groups as $group)
                                        <tr>
                                            <td colspan="2" ><h4>{{$group->name}}</h4></td>
                                        </tr>
                    @foreach($group->permissions as $per)
                                        <tr>
                                            <td>{{$per->display_name}}</td>
                                            <td><input value="{{$per->id}}" name="permission_id[]" type="checkbox" ></td>
                                        </tr>
                    @endforeach
        @endforeach
                                    </table>
   <div class="modal-footer">
        <a href="{{URL::route('role.index')}}" class="btn btn-flat btn-danger" >Cancel</a>
        <button type="submit" class="btn btn-flat btn-success">Create</button>
      </div>

        </div>
         {{Form::close()}}
        </div>
        </div>