<?php
declare (strict_types=1);

namespace app\validate;


use think\exception\ValidateException;
use think\Request;
use think\Response;
use think\Validate;

class BaseValidate extends Request
{
    /**
     * @var bool
     */
    public $batch = false;


    /**
     * @var string
     */
    protected $error = '';

    /**
     * @var string
     */
    protected $currentScene;

    /**
     * @var array
     */
    protected $scene = [];

    /**
     * @var array
     */
    protected $rule = [];

    /**
     * @var array
     */
    protected $message = [];

    /**
     * 指定场景验证
     *
     * @param string $scene
     *
     * @return $this
     */
    public function scene($scene)
    {
        $this->currentScene = $scene;

        return $this;
    }

    /**
     * 批量验证
     *
     * @param [type] $batch
     *
     * @return $this
     */
    public function batch($batch)
    {
        $this->batch = $batch;

        return $this;
    }

    /**
     * 验证数据.
     *
     * @return bool|Response
     */
    public function validate(array  $data)
    {
        try {
            $validate = new Validate();
            $validate->rule($this->rule);

            // 验证场景
            if ($this->currentScene) {
                $only = $this->scene[$this->currentScene];
                $validate->only($only);
            }

            $validate->rule($this->rule)
                ->message($this->message)
                ->batch($this->batch)
                ->failException(true)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();

            return false;
        }

        return true;
    }

    public function getError()
    {
        return $this->error;
    }
}
