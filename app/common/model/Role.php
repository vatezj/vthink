<?php

declare(strict_types=1);



namespace app\common\model;

use app\BaseModel;
use app\common\Contract\PermissionContract;
use app\common\Contract\UserContract;
use app\common\traits\Log;
use think\model\relation\BelongsToMany;



class Role extends BaseModel
{
    use Log;

    /**
     * 获取角色下所有权限.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.permission.model'),
            config('permission.role_permission_access'),
            config('permission.permission.froeign_key'),
            config('permission.role.froeign_key')
        );
    }

    /**
     * 获取角色下所有用户.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.user.model'),
            config('permission.user_role_access'),
            config('permission.user.froeign_key'),
            config('permission.role.froeign_key')
        );
    }

    /**
     * 为当前角色分配一个权限.
     *
     * @param [type] $permission
     *
     * @return void
     */
    public function assignPermission(PermissionContract $permission)
    {
        $this->permissions()->attach($permission);
    }

    /**
     * 为当前角色移除一个权限.
     *
     * @param [type] $permission
     *
     * @return void
     */
    public function removePermission(PermissionContract $permission)
    {
        $this->permissions()->detach($permission);
    }

    /**
     * 为当前角色移除所有权限.
     *
     * @param [type] $permission
     *
     * @return void
     */
    public function removeAllPermission()
    {
        $permissions = $this->permissions;

        foreach ($permissions as $permission) {
            $this->removePermission($permission);
        }
    }

    /**
     * @param UserContract $user
     * @throws \think\db\exception\DbException
     */
    public function assignUser(UserContract $user)
    {
        $this->users()->attach($user);
    }

    /**
     * @param UserContract $user
     */
    public function removeUser(UserContract $user)
    {
        $this->users()->detach($user);
    }

    /**
     * 通过名称查找角色.
     *
     * @param string $name
     */
    public static function findByName($name)
    {
        return self::where(['name' => $name])->find();
    }
    /**
     * 获取角色下部门.
     */
    public function depts(): BelongsToMany
    {
        return $this->belongsToMany(
            Dept::class,
            RoleDeptAccess::class,
            'dept_id',
            'role_id'
        );
    }
}
