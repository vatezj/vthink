<?php

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------

use think\facade\Env;

return [
    // 默认缓存驱动
    'default' => env('cache.driver', 'file'),

    // 缓存连接方式配置
    'stores'  => [
        'file' => [
            // 驱动方式
            'type'       => 'File',
            // 缓存保存目录
            'path'       => '',
            // 缓存前缀
            'prefix'     => '',
            // 缓存有效期 0表示永久缓存
            'expire'     => 0,
            // 缓存标签前缀
            'tag_prefix' => 'tag:',
            // 序列化机制 例如 ['serialize', 'unserialize']
            'serialize'  => [],
        ],
        // 更多的缓存连接

        'redis'   =>  [
            // 服务器地址
            'type'   => 'redis',

            'host' => Env::get('cacheredis.hostname', '127.0.0.1'),
            // 密码
            'password' => Env::get('cacheredis.password', ''),
            // 端口
            'port' => Env::get('cacheredis.hostport', '6379'),
        ],
    ],
];
