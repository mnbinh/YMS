<div class ='box'>
        {{Form::open(array('route'=> array('role.update' , 'id'=> $role->id) ,'method'=> 'PUT' , 'role' =>'form' , 'id'=> 'edit_role'))}}

  <div class="box-header">
                                    <h3 class="box-title">{{$role->name}}</h3>
                                </div><!-- /.box-header -->
        <div class="box-body table-responsive">
                            <table class="table">

        @foreach($groups as $group)
                                        <tr>
                                            <td colspan="2" ><h4>{{$group->name}}</h4></td>
                                        </tr>
                    @foreach($group->permissions as $per)
                                        <tr>
                                            <td>{{$per->display_name}}</td>
                                            <td><input value="{{$per->id}}" name="permission_id[]" type="checkbox" {{in_array($per->id,$per_roles) ? 'checked' : ''}}></td>
                                        </tr>
                    @endforeach
        @endforeach
                                    </table>
   <div class="modal-footer">
        <a href="{{URL::route('role.index')}}" class="btn btn-flat btn-danger" >Cancel</a>
        <button type="submit" class="btn btn-flat btn-success">Save</button>
      </div>

        </div>
         {{Form::close()}}
        </div>