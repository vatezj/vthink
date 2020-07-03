<?php

declare(strict_types=1);


namespace app\validate\admin;

use app\validate\BaseValidate;

class DeptValidate extends BaseValidate
{
    protected $rule = [
        'dept_name' => 'require|unique:dept',
        'dept_pid' => 'require',
    ];

    protected $message = [
        'dept_pid.require' => '父级必须',
        'dept_name.require' => '名称必须',
        'dept_name.unique' => '规则重复',
    ];
}
