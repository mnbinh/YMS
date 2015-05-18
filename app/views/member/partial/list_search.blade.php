<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cập nhật Danh sách Đoàn viên tham gia</h4>
    </div>
     <div class="modal-body">
       <div style="width: 30% ; align:center; margin-bottom: 5px"  >
                              {{Form::select('type', $unions,null,array('class' => 'form-control' ,'id'=> 'choose_union' ,'data-aid' =>$activity_id))}}
        </div>
{{ Datatable::table()
              ->addColumn('Identifier', 'Email' ,'Họ & Tên'  ,'Chi Đoàn' ,'Chọn'  )
              ->setUrl( URL::route('table.search.member', array('union_id'=>'0' , 'activity_id'=>$activity_id)))
              ->setOptions(array('bPaginate'=> true ,
                  'sPaginationType'=>'full_numbers',
                  'iDisplayLength' => 10 ,
                  "bPaginate" => true,
                  "bProcessing"=> true ,
                  "oLanguage" => array(
                      "sProcessing" => '<div style="position: absolute; left: 50%; top: 50%;

       "><i class="fa  fa-3x fa-spinner fa-spin"></i></div>'
                  ) ,
                  "bLengthChange"=> true,
                  "dom"=> '<"toolbar">frtip',
                  "bFilter"=> true,
                  "bSort"=> true,
                  "bInfo"=> true,
                  "bAutoWidth"=> false))->render()}}
<div class="row">
</div>
</div>
     <div class="modal-footer">

        <button type="button" class="btn btn-success btn-flat" ><i class="fa fa-upload"></i>Thêm Từ file</button>
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Đóng</button>
      </div>