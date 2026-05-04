<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class BestSellerReport extends BaseController
{
    use ResponseTrait;

    public function getPopular(): ResponseInterface
    {
        $year  = $this->request->getGet('year');
        $month = $this->request->getGet('month');
        $day   = $this->request->getGet('day');

        $builder = $this->db()->table('order_line ol')
            ->select('mi.menu_item_id, mi.item_name, b.brand_name, mi.menu_category, mi.price,
                SUM(ol.quantity) as total_quantity_sold,
                COUNT(DISTINCT ol.sales_invoice_id) as order_count')
            ->join('menu_item mi', 'mi.menu_item_id = ol.menu_item_id')
            ->join('brand b', 'b.brand_id = mi.brand_id')
            ->join('sales_invoice si', 'si.sales_invoice_id = ol.sales_invoice_id')
            ->groupBy('mi.menu_item_id, mi.item_name, b.brand_name, mi.menu_category, mi.price');

        if ($year) {
            $builder->where('YEAR(si.date_created)', $year);
        }
        if ($month) {
            $builder->where('MONTH(si.date_created)', $month);
        }
        if ($day) {
            $builder->where('DAY(si.date_created)', $day);
        }

        $result = $builder->orderBy('total_quantity_sold', 'DESC')->get()->getResultArray();

        return $this->respond($result, 200);
    }

    public function getRevenue(): ResponseInterface
    {
        $year  = $this->request->getGet('year');
        $month = $this->request->getGet('month');
        $day   = $this->request->getGet('day');

        $builder = $this->db()->table('order_line ol')
            ->select('mi.menu_item_id, mi.item_name, b.brand_name, mi.menu_category, mi.price,
                SUM(ol.line_total) as total_revenue,
                COUNT(DISTINCT ol.sales_invoice_id) as order_count,
                SUM(ol.quantity) as total_quantity_sold')
            ->join('menu_item mi', 'mi.menu_item_id = ol.menu_item_id')
            ->join('brand b', 'b.brand_id = mi.brand_id')
            ->join('sales_invoice si', 'si.sales_invoice_id = ol.sales_invoice_id')
            ->groupBy('mi.menu_item_id, mi.item_name, b.brand_name, mi.menu_category, mi.price');

        if ($year) {
            $builder->where('YEAR(si.date_created)', $year);
        }
        if ($month) {
            $builder->where('MONTH(si.date_created)', $month);
        }
        if ($day) {
            $builder->where('DAY(si.date_created)', $day);
        }

        $result = $builder->orderBy('total_revenue', 'DESC')->get()->getResultArray();

        return $this->respond($result, 200);
    }

    private function db()
    {
        return \Config\Database::connect();
    }
}
