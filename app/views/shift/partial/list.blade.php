@if($members->count())
<table class="table table-bordered">
<tbody>
<tr>
<th>Mã Đoàn Viên</th>
<th>Họ Tên</th>
<th>Chi Đoàn</th>
</tr>
@foreach($members as $member)
<tr>
<td>{{$member->student_id}}</td>
<td>{{ $member->first_name.' '.$member->last_name}}</td>
<td>{{$member->youth_union->name}}</td>
</tr>
@endforeach
</tbody>
</table>
@else

<div class="callout callout-danger">
    <h4>Chưa có đoàn viêm đăng ký</h4>
</div>
@endif