<table id="list_member" class="table table-bordered">

    <thead>
    <tr>
                <th align="center" valign="middle" class="head1">Mã</th>
                <th align="center" valign="middle" class="head2">Họ Tên</th>
                <th align="center" valign="middle" class="head8">Chi Đoàn</th>
            </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
                <tr>
                    <td align="center" valign="middle" class="head1">{{ $member->student_id }}</td>
                    <td align="left" valign="middle" class="head2">{{$member->first_name .' ' .$member->last_name}}</td>
                    <td align="left" valign="middle" class="head2">{{$member->youthUnion->name}}</td>
                    {{--<td align="center" valign="middle" class="head8">--}}
                    {{--<input type="checkbox" {{$member->unionActivities->count() ? 'checked' : ''}} class="check-multiple" data-id="{{$member->id}}" data-aid="{{$id}}">--}}

                    {{--</td>--}}
                </tr>
    @endforeach
   </tbody>
</table>