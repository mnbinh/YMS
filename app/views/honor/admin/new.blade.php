        {{ Form::open(array('action' => 'HonorController@storePeriod' ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_period')) }}
       @include('honor.partial.form',array( 'header' => 'Thêm chi đoàn mới' ))
       {{Form::close()}}