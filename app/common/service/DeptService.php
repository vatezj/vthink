<?php

declare(strict_types=1);


namespace app\common\service;

use app\BaseService;
use app\common\model\Dept;
use app\common\Util\Category;

class DeptService extends BaseService
{
    public function __construct(Dept $dept)
    {
        $this->model = $dept;
    }

    /**
     * 获取树状结构.
     */
    public function getTree()
    {
        $data = $this->model->select();
        $category = new Category(['dept_id', 'dept_pid', 'dept_name', 'cname']);

        return $category->formatTree($data->toArray());
    }

    /**
     * 获取子部门.
     *
     * @param [type] $deptPid
     */
    public function getChildrenDepts($deptPid)
    {
        $data = $this->model->select();
        $category = new Category(['dept_id', 'dept_pid', 'dept_name', 'cname']);

        return $category->getTree($data->toArray(), $deptPid);
    }
}
