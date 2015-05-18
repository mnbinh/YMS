{{ Form::open(array('route' => 'store_route' , 'files' => true)) }}
{{Form::file('excel')}}
{{Form::submit('Upload', array('class'=> 'btn'));}}
{{ Form::close() }}