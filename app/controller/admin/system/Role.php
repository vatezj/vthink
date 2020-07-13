<?php

declare(strict_types=1);



namespace app\controller\admin\system;

use app\BaseController;
use app\common\service\DeptService;
use app\common\service\PermissionService;
use app\common\service\RoleService;
use app\request\admin\RoleRequest;


class Role extends BaseController
{
    protected $permission;

    protected $dept;

    public function __construct(RoleService $service, PermissionService $permission, DeptService $dept)
    {
//        parent::__construct();

        $this->service = $service;
        $this->permission = $permission;
        $this->dept = $dept;
    }

    /**
     * 角色列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     *
     * @return \think\Response
     */
    public function list($pageNo = 1, $pageSize = 10)
    {
        $data = $this->service->getList((int) $pageNo, (int) $pageSize);
        $rules = $this->permission->getMenuPermission();
        $depts = $this->dept->getTree();
        $menu = $this->permission->getTree();

        return $this->sendSuccess(['roles' => $data, 'rules' => $rules, 'depts' => $depts, 'menu' => $menu]);
    }

    /**
     * 添加角色.
     *
     * @return \think\Response
     */
    public function add(RoleRequest $request)
    {
        if (!$request->scene('create')->validate()) {
            return $this->sendError($request->getError());
        }
        $save = $request->param();
        if (isset($save[$request->url()])) unset($save[$request->url()]);
        if ($this->service->add($save) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新角色.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function update($id, RoleRequest $request)
    {
        if (!$request->scene('update')->validate()) {
            return $this->sendError($request->getError());
        }
        $save = $request->param();
        if (isset($save[$request->url()])) unset($save[$request->url()]);
        if ($this->service->renew($id, $save) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除角色.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($this->service->remove($id) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新角色数据权限.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function mode(RoleRequest $request,$id)
    {
        $params = $request->param();
        if ($this->service->updateMode($id, $params) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }
}
