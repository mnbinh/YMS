<?php

class RoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /role
	 *
	 * @return Response
	 */
	public function index()
	{
		//

        $groups =  PermissionGroup::with('permissions')->get();
        $unions = YouthUnion::active()->lists('name' , 'id');
        array_unshift($unions, 'Tất cả');
        $roles = Role::all();
        $table =   Datatable::table()
            ->addColumn('Identifier', 'Email' ,'Họ & Tên'  ,'Chi Đoàn' ,'Manipulate' ,'' )
            ->setUrl( URL::route('admin.data.members', array('union_id'=>'0' , 'type'=>'default')))
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
                "bAutoWidth"=> false))
            ->noScript();
        return View::make('role.index', array('groups' => $groups , 'roles'=>$roles , 'table'=> $table , 'unions' => $unions));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /role/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $groups =  PermissionGroup::with('permissions')->get();
        $html = View::make('role.create',array('groups'=> $groups ))->render();
        return Response::json(array('html'=> $html));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /role
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $name = Input::get('name');
        $role = new Role;
        $role->name = $name ;
        $role->save();
        $array_per = Input::get('permission_id');
        $role->perms()->sync($array_per);
        return Redirect::route('role.index');
	}

	/**
	 * Display the specified resource.
	 * GET /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        $role = Role::find($id);
        $per_of_role = $role->perms->lists('id');
        $groups =  PermissionGroup::with('permissions')->get();
        $html = View::make('role.show',array('role'=> $role,'groups'=> $groups, 'per_roles' => $per_of_role))->render();
        return Response::json(array('html'=> $html));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /role/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $role = Role::find($id);
        $array_per = Input::get('permission_id');
        $role->perms()->sync($array_per);
        return Redirect::route('role.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        Role::destroy($id);
        return Response::json(array('message' =>'success'));
	}
    /**
     *
     */
    public function showRolesOfMembers($id)
    {
        $member = YouthMember::find($id);
        $user = $member->myAccount;
        $roles = Role::all();
        $member_roles = $user->roles->lists('id');
        $html = View::make('role.member-role' ,array('member'=> $member , 'roles'=>$roles , 'member_roles' => $member_roles))->render();
        return Response::json(array('html'=> $html));
    }
    /**
     *
     */
    public function updateRolesOfMembers()
    {
        $id = Input::get('member_id');
        $array_roles = Input::get('roles');
        $member = YouthMember::find($id);
        $user = $member->myAccount;
        if(isset($array_roles)) {
            $user->roles()->sync($array_roles);
        }else $user->roles()->sync(array());
        return Response::json(array('msg'=> 'success'));
    }

}