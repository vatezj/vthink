<?php

namespace app\controller;

use app\BaseController;
use think\App;
use think\facade\Request;
use think\Response;

class Index extends BaseController
{

    public function index()
    {
        return redirect(Request::url(true) . "console");
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }

    /**
     * @return Response
     */
    public function miss(): Response
    {
        if ($this->request->isAjax()) {
            return Response::create(['code' => 404, 'msg' => '请求地址不存在'], 'json', 404, []);
        }
        return Response::create('请求地址不存在', 'html', 404, []);
    }
}
