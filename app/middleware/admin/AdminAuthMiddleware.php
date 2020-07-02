<?php
declare (strict_types=1);

namespace app\middleware\admin;

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
        $user = session('login');
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
        return Response::create(['message' => '用户未登录', 'code' => 50000], 'json', 401);
    }
}
