<?php

declare(strict_types=1);



namespace app\validate\admin;

use app\validate\BaseValidate;

class PostValidate extends BaseValidate
{
    protected $rule = [
        'post_name' => 'require',
        'post_code' => 'require|unique:post',
    ];

    protected $message = [
        'post_name.require' => '名称必须',
        'post_code.require' => '标识必须',
        'post_code.unique'  => '标识重复',
    ];

    protected $scene = [
        'create' => ['post_name', 'post_code'],
        'update' => ['post_code'],
    ];
}
