<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class SalesPerformanceReport extends BaseController
{
    use ResponseTrait;

    public function getIndex(int $brandId): ResponseInterface
    {
        $year  = $this->request->getGet('year');
        $month = $this->request->getGet('month');
        $day   = $this->request->getGet('day');

        $builder = $this->db()->table("brand b")
        ->select("
            YEAR(si.date_created) year,
            MONTH(si.date_created) month,
            b.brand_name,
            mi.item_name as menu_item,
            SUM(ol.line_total) revenue,
            COUNT(ol.order_line_id) total_orders,
            SUM(ol.quantity) qty_sold")
        ->join("menu_item mi", "b.brand_id = mi.brand_id", "inner")
        ->join("order_line ol", "mi.menu_item_id = ol.menu_item_id", "left")
        ->join("sales_invoice si", "ol.sales_invoice_id = si.sales_invoice_id", "left")
        ->where("si.order_status", "Completed")
        ->where("b.brand_id", $brandId)
        ->groupBy("YEAR(si.date_created), MONTH(si.date_created), b.brand_name, mi.item_name")
        ->orderBy("b.brand_name, revenue desc, mi.item_name");

        log_message('debug', "Filtering by brand: $brandId, year: $year, month: $month, day: $day");

        if ($year) {
            $builder->where('YEAR(si.date_created)', $year);
        }
        if ($month) {
            $builder->where('MONTH(si.date_created)', $month);
        }
        if ($day) {
            $builder->where('DAY(si.date_created)', $day);
        }

        $result = $builder->get()->getResultArray();

        return $this->respond($result, 200);
    }

    private function db()
    {
        return \Config\Database::connect();
    }
}
