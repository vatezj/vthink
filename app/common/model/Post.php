<?php

declare(strict_types=1);



namespace app\common\model;

use app\BaseModel;
use app\common\traits\Log;

class Post extends BaseModel
{
    protected $pk = 'post_id';
    use Log;
}
