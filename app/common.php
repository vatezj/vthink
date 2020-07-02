<?php
// 应用公共文件

use think\Response;

if (!function_exists('dumpInfo')) {
    /**
     * @param $vars
     * @return Response
     */
    function dumpInfo($vars): Response
    {
        return Response::create($vars, 'json', 200, []);
    }
}


if (!function_exists('randomKey')) {
    /**
     * @param int $len
     * @return string
     */
    function randomKey($len = 11): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~0123456789#$%^&';
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $len; ++$i) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
