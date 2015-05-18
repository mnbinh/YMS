@if($periods->count())
@foreach ($periods as $period)
    <li data-value="{{$period->id}}"><a href="#">{{$period->name}}</a></li>
@endforeach
@else
<li data-value="none"><a href="#">Không Tồn Tại Đợt Khen Thưởng</a></li>
@endif