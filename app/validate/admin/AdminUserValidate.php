<?php
declare (strict_types=1);

namespace app\validate\admin;

use app\validate\BaseValidate;

class AdminUserValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '请填写用户名',
        'password.require' => '请填写用户密码',
    ];
    /**
     * 定义场景
     * @var array
     */
    protected $scene = [
        'login' => ['name', 'password'],
        'register' => ['name', 'password'],
    ];
}
