<?php

namespace App\Controllers;

class ReportSalesPerformance extends BaseController
{
    const PAGE_TITLE = 'Sales Performance Report';

    public function getIndex(): string
    {
        $brandId = $this->request->getCookie('brandId');
        $brandName = $this->request->getCookie('brandName');
    
        return view('report-sales-performance', [
            'pageTitle' => self::PAGE_TITLE,
            'brandId'   => $brandId,
            'brandName' => $brandName,
        ]);
    }
}
