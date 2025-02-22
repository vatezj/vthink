<?php

declare(strict_types=1);


return [
    // 超级管理员id
    'super_id' => 1,

    // 用户模型
    'user' => [
        'model' => \app\common\model\User::class,
        'froeign_key' => 'user_id',
    ],

    // 规则模型
    'permission' => [
        'model' => \app\common\model\Permission::class,
        'froeign_key' => 'permission_id',
    ],

    // 角色模型
    'role' => [
        'model' => \app\common\model\Role::class,
        'froeign_key' => 'role_id',
    ],

    // 角色与规则中间表模型
    'role_permission_access' => \app\common\model\RolePermissionAccess::class,


    // 用户与角色中间表模型
    'user_role_access' => \app\common\model\UserRoleAccess::class,
];
