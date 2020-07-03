<?php

declare(strict_types=1);



namespace app\validate\admin;

use app\validate\BaseValidate;

class RoleValidate extends BaseValidate
{
    protected $rule = [
        'name'  => 'require|unique:role',
        'title' => 'require',
    ];

    protected $message = [
        'name.require'  => '唯一标识必须',
        'name.unique'   => '唯一标识重复',
        'title.require' => '名称必须',
    ];

    protected $scene = [
        'create' => ['name', 'title'],
        'update' => ['name', 'title'],
    ];
}
