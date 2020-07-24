<?php
declare (strict_types=1);

namespace app\middleware\admin;

use app\common\model\UserLoginLog;
use think\facade\Session;
use think\Request;
use think\Response;

class AdminAuthMiddleware
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $model = new  UserLoginLog();
        if ($request->header('token')) {
            $token = str_replace('auth-token=', '', $request->header('token'));
            $request->token = $token;
            if ($model->checkTokenIsAllow($token)) {
                $user = $model->user;
            } else {
                return Response::create(['message' => $model->getError(), 'code' => 50002], 'json', 401);
            }
        } else {
            return Response::create(['message' => $request->header(), 'code' => 111], 'json', 401);
        }
        if (!$user) {
            return $this->handleNotLoggedIn($request);
        }
        $request->user = $user;
        return $next($request);
    }

    /**
     * 用户未登录.
     */
    public function handleNotLoggedIn(Request $request): Response
    {
        return Response::create(['message' => '用户登录过期', 'code' => 50001], 'json', 401);
    }
}
