        {{ Form::open(array('url' => 'unions/store' ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_union')) }}
       @include('union.partial.form',array( 'header' => 'Thêm chi đoàn mới' ))
       {{Form::close()}}