<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/22/2015
 * Time: 9:45 AM
 */

class PermissionGroupTableSeeder  extends Seeder{
    public function run()
    {




            PermissionGroup::create([
                'name' => 'Quản lý Tài Khoản & Phân Quyền',


            ]);
        PermissionGroup::create([
            'name' => 'Quản lý Hoạt Động Đoàn Khoa & Chi Đoàn',


        ]);
        PermissionGroup::create([
            'name' => 'Quản lý Quy Trình Khen Thưởng Đoàn Viên',


        ]);
        PermissionGroup::create([
            'name' => 'Quản lý Quy Trình Xét Duyệt Nòng Cốt',


        ]);
        PermissionGroup::create([
            'name' => 'Quản lý Thu Đoàn Phí',


        ]);
        PermissionGroup::create([
            'name' => 'Quản lý Thông Tin Chi Đoàn & Đoàn Viên',


        ]);
        PermissionGroup::create([
            'name' => 'Quản lý Thông Tin Ban Chấp Hành',


        ]);




    }
} 