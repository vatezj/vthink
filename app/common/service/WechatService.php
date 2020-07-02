<?php

declare(strict_types=1);



namespace app\common\service;

use EasyWeChat\Work\Application as Work;
use EasyWeChat\Payment\Application as Payment;
use EasyWeChat\OpenWork\Application as OpenWork;
use EasyWeChat\MiniProgram\Application as MiniProgram;
use EasyWeChat\OpenPlatform\Application as OpenPlatform;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;

class WechatService extends \think\Service
{
    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
        $apps = [
            'official_account' => OfficialAccount::class,
            'work'             => Work::class,
            'mini_program'     => MiniProgram::class,
            'payment'          => Payment::class,
            'open_platform'    => OpenPlatform::class,
            'open_work'        => OpenWork::class,
        ];

        foreach ($apps as $name => $class) {
            if (empty(config('wechat.' . $name))) {
                continue;
            }

            $config = array_merge(config('wechat.defaults'), config("wechat.{$name}.default", []));
            $this->app->bind("wechat.{$name}", new $class($config));
        }
    }

    /**
     * 执行服务
     *
     * @return mixed
     */
    public function boot()
    {
    }
}
