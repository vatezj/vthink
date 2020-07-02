<?php

namespace app\common\Contract;

use think\Collection;
use think\model\relation\BelongsToMany;

interface UserContract
{
    /**
     * 获取用户下所有角色.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;

    /**
     * 是否有此权限.
     *
     * @param string $permission
     *
     * @return bool
     */
    public function can($permission);

    /**
     * 是否绑定某个角色.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role);

    /**
     * @param RoleContract $role
     * @return mixed
     */
    public function assignRole(RoleContract $role);

    /**
     * @param RoleContract $role
     * @return mixed
     */
    public function removeRole(RoleContract $role);

    /**
     * 删除所有已绑定的角色.
     *
     * @return void
     */
    public function removeAllRole();

    /**
     * 按名称查找用户.
     *
     * @param string $name
     *
     * @return void
     */
    public static function findByName($name);

    /**
     * 是否超级管理员.
     *
     * @return bool
     */
    public function isSuper();

    /**
     * 获取用户权限（所属分组）.
     *
     * @return void
     */
    public function getAllPermissions(): Collection;
}
