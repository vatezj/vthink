<?php
declare (strict_types=1);

namespace app\middleware\admin;

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
//        return Response::create(['message' => '用户未登录', 'code' => 1], 'json', 401);
        if ($request->header('Authorization')) {
            $token = str_replace('auth-token=', '', $request->header('Authorization'));
            Session::setId($token);
        }

        $user = session('login');
//        return Response::create(['message' => '用户未登录', 'code' => $user], 'json', 401);
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
