<?php

declare(strict_types=1);


namespace app\common\traits;

trait Code
{
    protected $code;

    public function getCode()
    {
        return $this->error;
    }

}
