<?php

namespace App\Controllers\Api;

use App\Models\CustomerDemographicsModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class CustomerDemographics extends Controller
{
    use ResponseTrait;

    protected $customerDemographicsModel;

    public function __construct()
    {
        $this->customerDemographicsModel = new CustomerDemographicsModel();
    }

    /**
     * Get all customer demographics report
     */
    public function getReport()
    {
        try {
            $data = $this->customerDemographicsModel->getCustomerDemographics();
            
            if (!$data) {
                return $this->respond(['error' => 'No data found'], 404);
            }

            return $this->respond($data, 200);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get customer demographics filtered by date range
     */
    public function getByDateRange()
    {
        try {
            $startDate = $this->request->getGet('start_date');
            $endDate = $this->request->getGet('end_date');

            if (!$startDate || !$endDate) {
                return $this->respond(['error' => 'start_date and end_date are required'], 400);
            }

            $db = \Config\Database::connect();
            $builder = $db->table('customer c');

            $builder->select('
                c.customer_id,
                c.first_name,
                c.last_name,
                c.email_address,
                c.gender,
                YEAR(CURDATE()) - YEAR(c.birthday) - (DATE_FORMAT(CURDATE(), "%m%d") < DATE_FORMAT(c.birthday, "%m%d")) as age,
                c.city,
                COUNT(DISTINCT si.sales_invoice_id) as order_count,
                COALESCE(SUM(si.total_amount), 0) as total_spending,
                COALESCE(AVG(si.total_amount), 0) as avg_order_value,
                GROUP_CONCAT(DISTINCT mi.item_name SEPARATOR ", ") as favorite_items
            ');

            $builder->leftJoin('sales_invoice si', 'c.customer_id = si.customer_id');
            $builder->leftJoin('order_line ol', 'si.sales_invoice_id = ol.sales_invoice_id');
            $builder->leftJoin('menu_item mi', 'ol.menu_item_id = mi.menu_item_id');

            $builder->where('DATE(si.date_created) >=', $startDate);
            $builder->where('DATE(si.date_created) <=', $endDate);
            $builder->groupBy('c.customer_id');
            $builder->orderBy('total_spending', 'DESC');

            $data = $builder->get()->getResultArray();

            if (!$data) {
                return $this->respond(['error' => 'No data found for the given date range'], 404);
            }

            return $this->respond($data, 200);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }
}
