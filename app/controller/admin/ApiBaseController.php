<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\BaseController;
use think\Response;

class ApiBaseController extends BaseController
{
    /**
     * @param array $data
     * @param null $msg
     * @param int $code
     * @param array $header
     * @return Response
     */
    protected function sendSuccess($data = [], $msg = null, $code = 20000, $header = []): Response
    {
        $res = [];
        $res['message'] = $msg ?? '操作成功';
        $res['result'] = $data;
        $res['code'] = $code;
        return Response::create($res, 'json', 200, $header);
    }

    /**
     * @param null $msg
     * @param int $code
     * @param array $header
     * @return Response
     */
    protected function sendError($msg = null, $code = 50015, $header = []): Response
    {
        $res = [];
        $res['message'] = $msg ?? '操作失败';
        $res['code'] = $code;
        return Response::create($res, 'json', 200, $header);
    }
}
