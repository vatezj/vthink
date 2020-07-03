<?php

declare(strict_types=1);


namespace app;


use app\common\DataScope\Scope;
use think\Model;

class BaseModel extends Model
{
    public $sortBy = 'create_time';

    public $sortOrder = 'asc';

    protected $autoWriteTimestamp = true;

    protected $createTime = 'create_time';

    protected $updateTime = 'update_time';

    /**
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function all()
    {
        return $this->order($this->sortBy, $this->sortOrder)
            ->select();
    }


    /**
     * @param $input
     * @return $this
     */
    public function add($input)
    {
        $this->save($input);

        return $this;
    }

    /**
     * @param $id
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function remove($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $id
     * @param array $input
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function renew($id, array $input)
    {
        $model = $this->find($id);
        $model->save($input);

        return $model;
    }

    /**
     * @param $query
     * @param $alias
     */
    public function scopeDataAccess($query, $alias)
    {
        $dataScope = new Scope();
        $sql = $dataScope->handle($alias);

        $query->where($sql);
    }
}
