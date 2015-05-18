    {{ Form::model($union ,array('route' => array('union.update', $union->id) ,'method'=> 'put' , 'role' =>'form' , 'id'=> 'edit_union')) }}
       @include('union.partial.form',array('buttonText' => 'Lưu Thay Đổi' , 'header' => 'Chỉnh Sữa'))
       {{Form::close()}}