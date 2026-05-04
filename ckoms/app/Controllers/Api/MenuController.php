<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MenuItemModel;

class MenuController extends BaseController
{
    public function getIndex()
    {
        $model = new MenuItemModel();
        return $this->response->setJSON($model->findAll());
    }
}