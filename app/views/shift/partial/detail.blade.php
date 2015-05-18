
  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lịch trực </h4>
      </div>
      <div class="modal-body">


<table class="table table-bordered">
<tbody>
<tr>
<th>Ngày</th>
<th>Buổi</th>
<th>Cổng</th>
</tr>
@foreach($shifts as $shift)
<tr>
<td>{{$shift->date->format('d-m-Y')}}</td>
<td>Buổi {{ ($shift->time == '1') ? 'Sáng' : 'Chiều'}}</td>
<td>Cổng {{$shift->gate}}</td>
</tr>
@endforeach
</tbody>
</table>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
