<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cập nhật Danh sách Đoàn viên tham gia</h4>
    </div>
     <div class="modal-body">
<table id="list_member" class="table table-bordered">

    <thead>
    <tr>
                <th align="center" valign="middle" class="head1">Mã Đoàn Viên</th>
                <th align="center" valign="middle" class="head2">Họ Tên</th>
                <th align="center" valign="middle" class="head8">Tham gia</th>
            </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
                <tr>
                    <td align="center" valign="middle" class="head1">{{ $member->student_id }}</td>
                    <td align="left" valign="middle" class="head2">{{$member->first_name .' ' .$member->last_name}}</td>
                    <td align="center" valign="middle" class="head8">
                    <input type="checkbox" {{$member->unionActivities->count() ? 'checked' : ''}} class="check-multiple" data-id="{{$member->id}}" data-aid="{{$id}}">

                    </td>
                </tr>
    @endforeach
   </tbody>
</table>
<div class="row">
</div>
</div>
     <div class="modal-footer">

        <button type="button" class="btn btn-success btn-flat" ><i class="fa fa-upload"></i>Thêm Từ file</button>
        <a href="{{URL::route('attach.all.member' , array('id'=> $id))}}" class="btn btn-primary btn-flat">Thêm Tất cả</a>
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Đóng</button>
      </div>