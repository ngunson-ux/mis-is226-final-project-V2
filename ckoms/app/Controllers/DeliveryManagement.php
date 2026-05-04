<?php

namespace App\Controllers;

class DeliveryManagement extends BaseController
{
    const PAGE_TITLE = 'Delivery Management';

    public function getIndex(): string
    {
        return view('delivery-management', [
            'pageTitle' => self::PAGE_TITLE,
            'brandId'   => $this->request->getCookie('brandId') ?? '',
            'brandName' => $this->request->getCookie('brandName') ?? 'Cloud Kitchen',
        ]);
    }
}
