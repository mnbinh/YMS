<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



    Route::get('/',array('as' => 'root' ,'before' => array('auth') , function()
    {
        // Has Auth Filter
        $count_union = YouthUnion::active()->get()->count();
        $count_member = YouthMember::all()->count();
        $count_activity = SchoolActivity::all()->count();
        return View::make('home.index', ['union' => $count_union , 'member' => $count_member , 'activity' => $count_activity]);
    }));




Route::get('login', 'HomeController@loginMail');
Route::get('gauth',array('as' =>'google_auth' , 'uses' => 'HomeController@loginWithGoogle' ));

//

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

//Shift
Route::resource('shifts' , 'ShiftController');
Route::post('events', 'ShiftController@fetch');
Route::post('shifts/store' , 'ShiftController@store');
Route::post('shifts/restore' , array('as' => 'shifts.restore' ,'uses' => 'ShiftController@restore')) ;
Route::get('shifts-detail' , array('as' => 'shifts.detail' , 'uses' => 'ShiftController@detail'));
Route::get('shift-index-admin', array('as'=> 'shifts.index.admin' ,'uses'=> 'ShiftController@indexAdmin' ));
Route::post('shift-search', array('as'=>'shift.search' , 'uses' =>'ShiftController@searchList' ));



//Route of Union

Route::get('admin/unions', array('as'=> 'union.admin' , 'uses' => 'UnionController@index'));
Route::get('admin/union/create', array('as'=> 'admin.union.create' , 'uses' => 'UnionController@create'));
Route::get('union/import_excel' , array('as'=> 'union.import' , 'uses' => 'UnionController@import') );
Route::resource('union', 'UnionController');
Route::get('table-unions', array('as' => 'data.members', 'uses' => 'UnionController@getMembersDataTable'));
Route::get('unions/export', array('as' => 'unions.export', 'uses' => 'UnionController@exportUnion'));
Route::post('unions/store', 'UnionController@store');
Route::post('unions/stores', array('as'=> 'import_union_route' , 'uses' => 'ImportController@storeUnion'));
Route::get('unions/destroy' ,  array('as'=> 'unions.destroy' , 'uses' => 'UnionController@destroyMultiple'));
Route::get('secretary/{id}' , array('as' => 'set.secretary' , 'uses' => 'UnionController@setSecretary'));
Route::post('secretary/{id}' , array('as' => 'secretary.store' , 'uses' => 'UnionController@storeSecretary'));


//Routes  of Bonus
Route::get('admin/honors', array('as'=> 'honor.admin' , 'uses' => 'HonorController@indexAdmin'));
Route::post('store-period', array('as' =>'store.period' ,'uses' => 'HonorController@storePeriod'));
Route::post('honor-store-single/{id}' ,  array('as' => 'store.single' , 'uses'=> 'HonorController@storeSingle') );
Route::post('honor-store-single-admin' , array('as' => 'store.single.admin' , 'uses' => 'HonorController@storeSingleAdmin'));
Route::get('validate-member-id', array('as' => 'honor.validate.id', 'uses' => 'HonorController@validateId'));
Route::resource('honor', 'HonorController');
Route::get('show-honor/{id}' ,array('as'=> 'show.list-honor' , 'uses'=> 'HonorController@showList') );
Route::get('getdata-Honors', array('as' => 'data.honor', 'uses' => 'HonorController@getMembersDataTable'));
//Route::get('new-list-honors', array('as' => 'new.list.honor', 'uses' => 'HonorController@newListHonor'));
Route::post('new-list-honors', array('as' => 'new.list.honor', 'uses' => 'HonorController@newListHonor'));
Route::get('getdata-member', array('as' => 'data.member', 'uses' => 'MemberController@getDataMember'));
Route::post('honor/confirm-member' , array('as'=> 'confirm.honor.member' , 'uses' => 'HonorController@confirmMember')) ;
Route::post('honor/unconfirm-member' , array('as'=> 'unconfirm.honor.member' , 'uses' =>  'HonorController@unConfirmMember'));
Route::get('ajax/periods' , array('as' => 'ajax.periods' , 'uses' => 'HonorController@getPeriodsBySemester'));
Route::get('periods' , array('as'=> 'index.admin.period' ,'uses'=> 'HonorController@indexPeriod'));
Route::get('period/{id}' , array('as'=> 'show.admin.period' ,'uses'=> 'HonorController@showPeriod'));
Route::get('period/edit/{id}' , array('as'=> 'edit.admin.period' ,'uses'=> 'HonorController@editPeriod'));
Route::post('period/update/{id}' , array('as'=> 'update.admin.period' ,'uses'=> 'HonorController@updatePeriod'));
Route::get('ajax/detail-of-list' , array('as' => 'ajax.detail.of.list' , 'uses' => 'HonorController@getDetailOfList'));
Route::delete('period/{id}' , array('as'=> 'destroy.admin.period' ,'uses'=> 'HonorController@destroyPeriod'));
Route::get('create-single' , array('as' => 'create.admin.honor' , 'uses' => 'HonorController@getAddForm'));


//Routes  of Activity
Route::resource('activity', 'ActivityController');
Route::get('admin/activity' , array('as'=> 'admin.activity.index' , 'uses'=> 'ActivityController@indexAdmin'));
Route::get('get-all-activity', array('as' => 'get.all.activity' , 'uses'=> 'ActivityController@getActivityDataTable'));
Route::get('get-activity/{id}' , array('as' => 'data.show.activity' , 'uses' =>'ActivityController@getActivity' ));
Route::post('attach-member' , array('as'=> 'attach.member' , 'uses'=> 'ActivityController@attachMember'));
Route::post('detach-member' , array('as'=> 'detach.member' , 'uses'=> 'ActivityController@detachMember'));
Route::post('school-attach-member' , array('as'=> 'school.attach.member' , 'uses'=> 'ActivityController@schoolAttachMember'));
Route::post('school-detach-member' , array('as'=> 'school.detach.member' , 'uses'=> 'ActivityController@schoolDetachMember'));
Route::get('activity/{id}/attach-all', array('as'=>'attach.all.member' , 'uses' => 'ActivityController@attachAllMembers'));
Route::post('confirm-activity' , array('as'=> 'confirm.activity' , 'uses' => 'ActivityController@confirmActivity'));
Route::post('un-confirm-activity' , array('as'=> 'del.confirm.activity' , 'uses' => 'ActivityController@delConfirmActivity'));
Route::get('member' ,array('as'=>'member.activities' , 'uses'=> 'ActivityController@getActivityOfMember'));
Route::get('member/activities' ,array('as'=>'partial.member.activities' , 'uses'=> 'ActivityController@getPartialActivityOfMember'));

Route::get('admin/school-activity' , array('as'=> 'admin.school.activity' , 'uses'=> 'ActivityController@indexSchool'));
Route::get('admin/school-activity/{activity}' , array('as'=> 'school.activity.show' , 'uses'=> 'ActivityController@showSchool'));
Route::get('admin/create-school-activity' ,array('as' => 'school.activity.new' ,'uses'=> 'ActivityController@createSchool'));
Route::post('admin/school-activity/store' , array('as'=> 'school.activity.store' , 'uses' => 'ActivityController@storeSchool'));
Route::get('school-activity' , array('as' => 'school.activity.get' , 'uses' => 'ActivityController@getAvailableSchool'));
Route::post('attach-union' , array('as'=> 'attach.union' , 'uses'=> 'ActivityController@attachUnion'));
Route::post('detach-union' , array('as'=> 'detach.union' , 'uses'=> 'ActivityController@detachUnion'));
Route::get('table-join-member' ,array('as' => 'table.join.member' , 'uses' => 'ActivityController@getDataJoinMembers'));


//Routes of YouthMember
Route::resource('members' , 'MemberController');
Route::get('members-export' , array('as' => 'members.export' , 'uses' => 'MemberController@exportMembers'));
Route::get('members-create-excel' , array('as'=> 'members.create.excel' , 'uses' => 'MemberController@createExcel'));
Route::post('members-destroy-multiple' , array('as' => 'members.destroy.multiple','uses' => 'MemberController@destroyMembers'));
Route::post('members-store-excel' , array('as' => 'members.store.excel','uses' => 'ImportController@storeMember'));

Route::get('member-of-union/{id}' ,array('as'=>'get.member' , 'uses'=> 'MemberController@getMemberOfUnion'));
Route::get('all-member',array('as' => 'admin.data.members' , 'uses' => 'MemberController@getDataUser'));
Route::get('member-of-activity', array('as' => 'ajax.members.activity' , 'uses' => 'MemberController@listMembersOfActivity'));
Route::get('member-search' ,array('as'=>'search.member' , 'uses'=> 'MemberController@searchMember'));
Route::get('data-member-search' ,array('as' => 'table.search.member' ,'uses' => 'MemberController@getSearchUser'));
Route::get('data-member-table' , array('as'=> 'data.table.member' , 'uses'=>'MemberController@getDataTableMember'));
Route::get('member-check-mail', array('as' => 'check.email.unique' ,'uses'=>'MemberController@checkEmailUnique'));
Route::get('member-check-id', array('as' => 'check.id.unique' ,'uses'=>'MemberController@checkIdUnique'));


//Route of UnionFee
Route::resource('fee' , 'FeeController');
Route::get('admin/fee' , array('as'=> 'admin.fee.index' , 'uses' => 'FeeController@indexAdmin'));
Route::get('admin/fee-data' ,array('as'=> 'admin.data.fee' , 'uses'=> 'FeeController@getDataMonthFee'));
Route::get('fee-data' , array('as'=>'union.data.fee' , 'uses' => 'FeeController@getDataStudentFee'));
Route::post('pay-fee' , array('as'=> 'pay.fee' , 'uses'=> 'FeeController@payFee'));
Route::post('re-pay-fee' , array('as'=> 're.pay.fee' , 'uses'=> 'FeeController@rePayFee'));
Route::get('admin/union-fee' ,array('as' => 'admin.fee.union' , 'uses' => 'FeeController@manageFee'));
Route::get('admin/union-fee-data' ,array('as'=> 'admin.data.union.fee' , 'uses'=> 'FeeController@getDataUnionFee'));
Route::get('admin/allow-pay' ,array('as'=> 'admin.allow.pay' , 'uses'=> 'FeeController@allowPay'));
Route::get('admin/allow-change-union' , array('as' => 'allow.change.union' , 'uses' =>'FeeController@allowPayChangeUnion'));
Route::post('admin/union-pay' , array('as'=> 'admin.union.pay' , 'uses' => 'FeeController@checkUnionPay'));
Route::post('admin/union-repay' , array('as'=> 'admin.union.re.pay' , 'uses' => 'FeeController@recheckUnionPay'));

//Route of core
Route::resource('core','CoreController');
Route::get('appoint-member', array('as' => 'appoint.member' , 'uses' => 'CoreController@showCore'));
Route::get('table-core-members', array('as'=>'table.core' , 'uses'=> 'CoreController@getDataCoreMember'));
Route::get('table-appoint-members', array('as'=>'table.appoint' , 'uses'=> 'CoreController@getDataAppointMember'));
Route::post('store-list-core', array('as' => 'store.list.core' , 'uses' => 'CoreController@storeListCore'));
Route::get('appoint-member/create' ,array('as' => 'create.core.member' , 'uses'=> 'CoreController@createAppoint'));
Route::post('store-single/{id}' ,  array('as' => 'store.appoint' , 'uses'=> 'CoreController@storeSingle') );
Route::get('check-list-exist' , array('as' => 'check.list.core', 'uses' => 'CoreController@checkListExist'));
Route::get('validate-member-id', array('as' => 'core.validate.id', 'uses' => 'CoreController@validateId'));
Route::get('detail-list-appoint' , array('as'=>'ajax.detail.list.appoint' , 'uses' =>'CoreController@getDetailOfList'  ));
Route::post('cores/confirm-member' , array('as'=> 'confirm.core.member' , 'uses' => 'CoreController@confirmMember')) ;
Route::post('cores/unconfirm-member' , array('as'=> 'unconfirm.core.member' , 'uses' =>  'CoreController@unConfirmMember'));

//Route of Competence
Route::resource('competence' , 'CompetenceController');
Route::get('admin/competence-date' , array('as'=>'admin.data.competence' , 'uses'=>'CompetenceController@getDataCompetence'));
Route::get('competence-get-data', array('as' => 'competence.data.member', 'uses' => 'CompetenceController@getDataMember'));

//Route of Role-Permission
Route::resource('role' , 'RoleController');
Route::get('member/{id}/role', array('as'=> 'show.member.role' , 'uses' => 'RoleController@showRolesOfMembers'));
Route::post('member/update-info' , array('as'=> 'update.member.role' , 'uses' =>'RoleController@updateRolesOfMembers' ));

//Route of Teacher
Route::resource('teacher','TeacherController');
Route::get('teacher-datatable', array('as'=>'teacher.data' , 'uses'=> 'TeacherController@getDataTable'));
Route::get('teacher-export', array('as'=>'teacher.export' , 'uses' => 'TeacherController@export'));
Route::get('teacher-excel', array('as'=>'teacher.create.excel' , 'uses' => 'TeacherController@export'));
Route::get('teacher-check-id', array('as'=>'check.teacher.id' , 'uses'=>'TeacherController@checkId'));
Route::get('teacher-check-email', array('as'=>'check.teacher.email' , 'uses'=>'TeacherController@checkEmail'));


Route::get('upload' , function(){
return View::make('excel');
});
Route::post('store', array('as'=> 'store_route' , 'uses' => 'UnionController@store'));


//Test Eloquent Route

Route::get('test/{id}', function($id){
    //HAS MANY
//    $members = YouthUnion::find(1)->members();// has many type
//    var_dump($members->getResults()->get(0)->first_name);
    //Dynamic Property
 //   $members = YouthUnion::find(1)->members;  collection type (dynamic property)
//var_dump($members->get(0)->first_name);
//BELONG TO
//    $Union = YouthMember::find(61)->myUnion();
//    var_dump($Union->getResults()); //Object type
   // var_dump($Union->firstOrFail());//Object type
    //Dynamic Property
//        $Union = YouthMember::find(61)->myUnion;
//    var_dump($Union->toJson()); //Object type
    //Return unicode json
//    return json_encode(YouthUnion::all(),JSON_UNESCAPED_UNICODE );
//return YouthMember::all();
//    $c =YouthUnion::first();
//    $c->secretaries()->attach(61);
//dd($c->secretaries()->first()->email);
//
//    var_dump(Period::find(1)->felicitations()->with('member')->get()->get(0)->member->last_name);
//    var_dump(DB::getQueryLog());
//    $activity = UnionActivity::find($id);
//    $union = $activity->youthUnion;
//    $members = $union->youthMembers()->with(array('unionActivities'  => function ($q) use ($id) {
//        $q->equal($id);
//    }))->joined()->get();
//    $members->first()->unionActivities->count();
//    $members->get(2)->unionActivities->count();



//        $y =YouthUnion::with(['youthMembers' => function($query)use ($id) {
//        $query->with(['monthFees' => function($q2)use($id){
//            $q2->where('pays.check' , 0)->year($id)->month('1');}]);}])->firstOrFail();
//    $sum = 0;
//    foreach($y->youthMembers as $youthMember)
//    {
//        if($youthMember->monthFees->count()) {
//            foreach($youthMember->monthFees as $monthFee){
//                $sum = $sum + $monthFee->fee;
//            }
//        }
//
//    }
//    var_dump($sum);
//    $d = CompetenceDetail::whereHas('youthMemberWithUnion',function ($q) {
//                    $q->where('youth_unions.id' , 1);
//    })->get();
//
//    $d = ExecutiveDetail::union($id)->schoolProrogue(2)->with('schoolProrogue' , 'competence' ,'youthMemberWithFull')->get();
//  var_dump($d->toArray());
//    $d1 = CompetenceDetail::union($id)->with('prorogue' , 'competence' ,'youthMemberWithFull')->get();
//    var_dump($d1->toArray());
//   $d1 = ExecutiveDetail::union($id)->schoolProrogueId(2)->with('schoolProrogue', 'youthMemberWithFull')->get();
//    var_dump($d1->toArray());
//    $member = YouthMember::find(61);
//    $activity = $member->unionActivities()->semesterId(5);
//    var_dump($activity->get()->toArray());
//    $user = Confide::user();
//    $union = $user->youthMember->youthUnion;
//    $lists =  $union->listFelicitations()->get()->lists('period_id');

    $member = Confide::user()->youthMember ;

    $shifts = $member->shifts()->where('date' ,'>' , date('Y-m-d'));
  dd($shifts->toArray());

});

Route::when('*', 'posts.view_throttle');
Route::filter('posts.view_throttle', 'ViewThrottleFilter');



//Event::listen('illuminate.query', function($query)
//{
//    var_dump($query);
//});
