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

$header['Access-Control-Allow-Origin'] = '*';

Route::group('/admin/auth', function () {
    Route::post('/login', 'admin.auth/login');
    Route::post('/register', 'admin.auth/register');
})->allowCrossDomain();


Route::group('/admin/user', function () {
    Route::get('/info', 'admin.auth/info');
    Route::get('/get', 'admin.auth/info')->middleware(Permission::class, '1');
})->middleware(AdminAuthMiddleware::class);
Route::post('/admin/auth/logout', 'admin.auth/logout')
    ->allowCrossDomain()
    ->middleware(AdminAuthMiddleware::class);

// 模拟数据（可删除）
Route::group('/admin/mock', function () {
    Route::get('/list/search/projects', 'admin.mock/projects');
    Route::get('/workplace/activity', 'admin.mock/activity');
    Route::get('/workplace/radar', 'admin.mock/radar');
    Route::get('/workplace/teams', 'admin.mock/teams');
});


Route::group('/admin', function () {
// 规则

    Route::group('/system', function () {
        Route::rule('/dept', 'admin.system.dept/list', 'GET')->middleware(Permission::class, 'DeptGet');
        Route::rule('/dept', 'admin.system.dept/create', 'POST')->middleware(Permission::class, 'DeptAdd');
        Route::rule('/dept/:id', 'admin.system.dept/update', 'PUT')->middleware(Permission::class, 'DeptUpdate');
        Route::rule('/dept/:id', 'admin.system.dept/delete', 'DELETE')->middleware(Permission::class, 'DeptDelete');

        Route::rule('/post', 'admin.system.post/create', 'POST')->middleware(Permission::class, 'PostAdd');
        Route::rule('/post', 'admin.system.post/all', 'GET')->middleware(Permission::class, 'PostGet');
        Route::rule('/post/:id', 'admin.system.post/update', 'PUT')->middleware(Permission::class, 'PostUpdate');
        Route::rule('/post/:id', 'admin.system.post/delete', 'DELETE')->middleware(Permission::class, 'PostDelete');
    })->middleware(AdminAuthMiddleware::class);


    Route::group('/permission', function () {
        Route::rule('/', 'admin.system.permission/list', 'GET')
            ->middleware(Permission::class, 'PermissionGet');
        Route::rule('/', 'admin.system.permission/add', 'POST')
            ->middleware(Permission::class, 'PermissionAdd');
        Route::rule('/:id', 'admin.system.permission/renew', 'PUT')
            ->middleware(Permission::class, 'PermissionUpdate');
        Route::rule('/:id', 'admin.system.permission/remove', 'DELETE')
            ->middleware(Permission::class, 'PermissionDelete');
    })->allowCrossDomain()->middleware(AdminAuthMiddleware::class);

// 角色
    Route::group('/role', function () {
        Route::rule('/', 'admin.system.role/list', 'GET')
            ->middleware(Permission::class, 'RoleGet');
        Route::rule('/', 'admin.system.role/add', 'POST')
            ->middleware(Permission::class, 'RoleAdd');
        Route::rule('/:id$', 'admin.system.role/update', 'PUT')
            ->middleware(Permission::class, 'RoleUpdate');
        Route::rule('/:id$', 'admin.system.role/delete', 'DELETE')
            ->middleware(Permission::class, 'RoleDelete');
        Route::rule('/:id/mode', 'admin.system.role/mode', 'PUT');
    })->allowCrossDomain()->middleware(AdminAuthMiddleware::class);


// 用户
    Route::group('/user', function () {
        //获取 个人信息
        Route::rule('/current$', 'admin.system.user/current', 'GET');
        //更新 个人信息
        Route::rule('/current$', 'admin.system.user/updateCurrent', 'PUT');
        //更新 头像
        Route::rule('/avatar$', 'admin.system.user/avatar', 'POST');
        //更新 密码
        Route::rule('/reset-password$', 'admin.system.user/resetPassword', 'PUT');
        Route::rule('/', 'admin.system.user/list', 'GET')
            ->middleware(Permission::class, 'AccountGet');
        Route::rule('/', 'admin.system.user/add', 'POST')
            ->middleware(Permission::class, 'AccountAdd');
        Route::rule('/info$', 'admin.system.user/info', 'GET');
        Route::rule('/:id', 'admin.system.user/update', 'PUT')
            ->middleware(Permission::class, 'AccountUpdate');
        Route::rule('/:id', 'admin.system.user/delete', 'DELETE')
            ->middleware(Permission::class, 'AccountDelete');
    })->allowCrossDomain()->middleware(AdminAuthMiddleware::class);

// 日志
    Route::group('/log', function () {
        Route::rule('/acount', 'admin.log.AccountLog/list', 'GET')
            ->middleware(Permission::class, 'LogAccountGet');
        Route::rule('/acount', 'admin.log.AccountLog/delete', 'DELETE')
            ->middleware(Permission::class, 'LogAccountDelete');
        Route::rule('/db', 'admin.log.DataBaseLog/list', 'GET')
            ->middleware(Permission::class, 'LogDbGet');
        Route::rule('/db', 'admin.log.DataBaseLog/delete', 'DELETE')
            ->middleware(Permission::class, 'LogDbDelete');
    })->allowCrossDomain()->middleware(AdminAuthMiddleware::class);

});






