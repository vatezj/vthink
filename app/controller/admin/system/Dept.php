<?php

declare(strict_types=1);


namespace app\controller\admin\system;

use app\BaseController;
use app\common\service\DeptService;
use app\request\admin\DeptRequest;


class Dept extends BaseController
{
    public function __construct(DeptService $service)
    {

        $this->service = $service;
    }

    /**
     * 部门列表.
     *
     * @return \think\Response
     */
    public function list()
    {
        $data = $this->service->getTree();

        return $this->sendSuccess($data);
    }

    /**
     * 添加部门.
     *
     * @return \think\Response
     */
    public function create(DeptRequest $request)
    {
        if (!$request->scene('create')->validate()) {
            return $this->sendError($request->getError());
        }
        $save = $request->param();
        if (isset($save[$request->url()])) unset($save[$request->url()]);
        if (!$this->service->add($save)) {
            return $this->sendError($this->service->getError());
        }
        return $this->sendSuccess();
    }

    /**
     * 更新部门.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function update($id, DeptRequest $request)
    {
        if (!$request->scene('update')->validate()) {
            return $this->sendError($request->getError());
        }
        $save = $request->param();
        if (isset($save[$request->url()])) unset($save[$request->url()]);
        if (!$this->service->renew($id, $save)) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除部门.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($this->service->delete($id) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }
}