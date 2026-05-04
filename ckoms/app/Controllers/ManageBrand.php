<?php

namespace App\Controllers;

use App\Models\BrandModel;

class ManageBrand extends BaseController
{
    const PAGE_TITLE = 'Manage Brand';

    public function getIndex(): string
    {
        $model = new BrandModel();
        $page = $this->request->getGet('page');
        $data = [
            'data'  => $model->paginate(8, 'default', $page),
            'pager' => $model->pager,
        ];
        return view('manage-brand',[
            'result'    => $data,
            'pageTitle' => self::PAGE_TITLE,
            'brandId'   => '',
            'brandName' => 'Cloud Kitchen',
        ]);
    }
}