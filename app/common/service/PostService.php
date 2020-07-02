<?php

declare(strict_types=1);



namespace app\common\service;

use app\BaseService;
use app\common\model\Post;

class PostService extends BaseService
{
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * 岗位列表.
     */
    public function getList()
    {
        $data = $this->model->order('post_sort desc')->select();

        return [
            'data'       => $data,
            'pageSize'   => 10,
            'pageNo'     => 1,
            'totalPage'  => 1,
            'totalCount' => count($data),
        ];
    }
}
