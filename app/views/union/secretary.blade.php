    {{ Form::open(array('route' => array('secretary.store', $id) ,'method'=> 'post' , 'role' =>'form' , 'id'=> 'add_secretary')) }}
       @include('union.partial.form',array('buttonText' => 'Lưu Thay Đổi' , 'header' => 'Chọn Bí thư' , 'secretary' =>'secretary'))
       {{Form::close()}}