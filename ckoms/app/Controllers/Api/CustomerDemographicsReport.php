<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class CustomerDemographicsReport extends BaseController
{
    use ResponseTrait;

    public function index(): ResponseInterface
    {
        $db = \Config\Database::connect();

        // Get demographics data
        $query = "
            SELECT 
                c.customer_id,
                c.first_name,
                c.last_name,
                c.email_address,
                c.birthday,
                YEAR(FROM_DAYS(DATEDIFF(NOW(), c.birthday))) AS age,
                c.city,
                c.province,
                COUNT(DISTINCT si.sales_invoice_id) AS order_count,
                COALESCE(SUM(si.total_amount), 0) AS total_spending,
                COALESCE(AVG(si.total_amount), 0) AS avg_order_value,
                GROUP_CONCAT(DISTINCT mi.item_name SEPARATOR ', ') AS favorite_items
            FROM customers c
            LEFT JOIN sales_invoices si ON c.customer_id = si.customer_id
            LEFT JOIN order_lines ol ON si.sales_invoice_id = ol.sales_invoice_id
            LEFT JOIN menu_items mi ON ol.menu_item_id = mi.menu_item_id
            GROUP BY c.customer_id
            ORDER BY total_spending DESC
        ";

        $result = $db->query($query)->getResultArray();

        return $this->respond($result);
    }

    // Get demographics by date range
    public function byDateRange(): ResponseInterface
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if (!$startDate || !$endDate) {
            return $this->failValidationErrors('start_date and end_date are required');
        }

        $db = \Config\Database::connect();

        $query = "
            SELECT 
                c.customer_id,
                c.first_name,
                c.last_name,
                YEAR(FROM_DAYS(DATEDIFF(NOW(), c.birthday))) AS age,
                COUNT(DISTINCT si.sales_invoice_id) AS order_count,
                COALESCE(SUM(si.total_amount), 0) AS total_spending
            FROM customers c
            LEFT JOIN sales_invoices si ON c.customer_id = si.customer_id 
                AND DATE(si.order_date) BETWEEN ? AND ?
            GROUP BY c.customer_id
            ORDER BY total_spending DESC
        ";

        $result = $db->query($query, [$startDate, $endDate])->getResultArray();

        return $this->respond($result);
    }
}