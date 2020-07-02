<?php

namespace app\common\Contract;

use think\model\relation\BelongsToMany;

interface RoleContract
{
    /**
     * 获取角色下所有权限.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany;

    /**
     * 获取角色下所有用户.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany;

    /**
     * @param PermissionContract $permission
     * @return mixed
     */
    public function assignPermission(PermissionContract $permission);

    /**
     * @param PermissionContract $permission
     * @return mixed
     */
    public function removePermission(PermissionContract $permission);

    /**
     * 为当前角色移除所有权限.
     *
     * @return void
     */
    public function removeAllPermission();

    /**
     * @param UserContract $user
     * @return mixed
     */
    public function assignUser(UserContract $user);

    /**
     * @param UserContract $user
     * @return mixed
     */
    public function removeUser(UserContract $user);

    /**
     * 通过名称查找角色.
     */
    public static function findByName($name);
}
