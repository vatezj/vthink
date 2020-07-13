<?php

declare(strict_types=1);


namespace app;

use app\common\traits\Code;
use app\common\traits\Error;

class BaseService
{
    use Error;
    use Code;

    public $model;

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }

    public function add(array $input)
    {
        return $this->model->add($input);
    }



    public function find($id)
    {
        return $this->model->find($id);
    }

    public function renew($id, array $input)
    {
        return $this->model->renew($id, $input);
    }

    public function remove($id)
    {
        return $this->model->remove($id);
    }


}
