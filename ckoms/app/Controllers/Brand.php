<?php

namespace App\Controllers;

use App\Models\BrandModel;

class Brand extends BaseController
{

    private const PAGETITLE = 'Welcome to CloudRave!';

    public function getSelection()
    {
        $brandModel = new BrandModel();

        return view('brand-selection', [
            'brands' => $brandModel->findAll(),
            'pageTitle' => self::PAGETITLE,
            'brandId' => '',
            'brandName' => 'CloudRave',
        ]);
    }
}