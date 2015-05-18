  {{ Form::open(array('route' => 'import_union_route' , 'files' => true)) }}
    @include('union.partial.form',array('import' => 'excel' , 'header' => 'Thêm chi đoàn mới'))


                            {{ Form::close() }}