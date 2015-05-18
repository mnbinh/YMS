   {{Form::open(array('route'=> 'update.member.role' ,'method'=> 'POST' , 'role' =>'form' , 'id'=> 'edit_user_role'))}}

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Phân Quyền User</h4>
      </div>
      <div class="modal-body">
      <div class="form-group row">
   {{Form::hidden('member_id'  ,$member->id, array('class' =>'form-control' ))}}
        {{Form::label('student_id' , 'Identifier:' ,array('class'=>'col-md-3 control-label'))}}
        <div class="col-md-5">
        {{Form::text('student_id'  ,$member->student_id, array('class' =>'form-control' ))}}
        </div>
    </div>
    <div class="form-group row">

        {{Form::label('email' , 'Email:' ,array('class'=>'col-md-3 control-label'))}}
        <div class="col-md-5">
        {{Form::text('email'  , $member->email, array('class' =>'form-control' ))}}
        </div>
    </div>
    <div class="form-group row">
    <div class="col-md-offset-3 col-md-5">
    @foreach($roles as $role)

    <div class="checkbox">
        <label>
            <input type="checkbox" name="roles[]" value="{{$role->id}}" {{in_array($role->id, $member_roles) ? 'checked' : ''}} > {{$role->name}}
        </label>
    </div>

    @endforeach
    </div>
    </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-flat btn-primary"> Save</button>
      </div>
      {{Form::close()}}