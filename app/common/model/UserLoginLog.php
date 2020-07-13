<?php

declare(strict_types=1);


namespace app\common\model;

use app\BaseModel;
use app\common\traits\Error;

class UserLoginLog extends BaseModel
{
    use Error;

    public $user;

    /**
     * @param array $arr
     * @return bool|string
     */
    public function _add(array $arr)
    {
        $save['user_id'] = $arr['user_id'];
        $save['ip'] = $arr['ip'];
        $save['user_agent'] = $arr['user_agent'];
        if (isset($arr['token'])) {
            $save['action_time'] = date('Y-m-d H:i:s');
            return $this->where('token', $arr['token'])->save($save);
        } else {
            $save['token'] = $this->_makeToken($arr['user_id']);
            $save['action_time'] = date('Y-m-d H:i:s');
            $save['login_time'] = date('Y-m-d H:i:s');
            $this->save($save);
            return $save['token'];
        }
    }

    /**
     * @param string $user_id
     * @return string
     */
    private function _makeToken(int $user_id): string
    {

        return md5($user_id . time());
    }


    public function checkTokenIsAllow(string $token)
    {
        $info = $this->where(['token'=>$token])
            ->field('user_id,login_time,action_time')
            ->find();
        if ($info) {
            $this->user = User::find($info['user_id']);
            return true;
        } else {
            $this->error = $token;
            return false;
        }


    }
}
