<?php

namespace app\controller\admin;


use app\common\service\UserService;
use app\model\AdminUserModel;
use app\validate\admin\AdminUserValidate;
use think\facade\Session;
use think\Response;


class Auth extends ApiBaseController
{
    /**
     * @param AdminUserValidate $validate
     * @return Response
     */
    public function login(AdminUserValidate $validate, UserService $service): Response
    {
        $validate->scene('login');
        if (!$validate->validate($this->request->param())) {
            return $this->sendError($validate->getError());
        }
        $info = $service->login($this->request->param('username'), $this->request->param('password'));
        if (!$info) {
            return $this->sendError($service->getError());
        }
        $sessionId = $service->makeToken($info);
        return $this->sendSuccess(['token' => $sessionId, 'expires_in' => 3600 * 24], '登录成功');
    }

    /**
     * @param AdminUserValidate $validate
     * @param UserService $service
     * @return Response
     */
    public function register(AdminUserValidate $validate, UserService $service): Response
    {
        $validate->scene('register');
        if (!$validate->validate($this->request->param())) {
            return $this->sendError($validate->getError());
        }
        $arr = [
            'name' => $this->request->param('username'),
            'nickname' => 'vates',
            'status' => 1,
            'dept_id' => 3,
            'roles' => ['2'],

            'password' => $this->request->param('password'),
        ];
        $info = $service->add($arr);
        if (!$info) {
            return dumpInfo($service->getError());
        }
        return dumpInfo('正确');
    }

    /**
     * @return Response
     */
    public function info(UserService $service): Response
    {
        return  $this->sendSuccess($service->info($this->request->user));

    }


}
