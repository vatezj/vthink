<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
use app\middleware\admin\AdminAuthMiddleware;
use app\middleware\admin\Permission;


Route::group('/admin', function () {
    Route::post('/login', 'admin.auth/login');
    Route::post('/logout', 'admin.auth/logout');
    Route::post('/register', 'admin.auth/register');
})->allowCrossDomain();


Route::group('/admin', function () {
    Route::get('/info', 'admin.auth/info');
    Route::get('/get', 'admin.auth/info')->middleware(Permission::class,'1');
})->allowCrossDomain()->middleware(AdminAuthMiddleware::class);





