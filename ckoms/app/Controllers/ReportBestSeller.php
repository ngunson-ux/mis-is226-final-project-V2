<?php

namespace App\Controllers;

class ReportBestSeller extends BaseController
{
    const PAGE_TITLE = 'Best Seller Report';

    public function getIndex(): string
    {
        return view('report-best-seller', [
            'pageTitle' => self::PAGE_TITLE,
            'brandId'   => '',
            'brandName' => 'Cloud Kitchen',
        ]);
    }
}
