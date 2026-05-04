<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Orders extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT 
                c.first_name,
                si.sales_invoice_id,
                mi.item_name,
                ol.quantity
            FROM customer c
            JOIN sales_invoice si ON c.customer_id = si.customer_id
            JOIN order_line ol ON si.sales_invoice_id = ol.sales_invoice_id
            JOIN menu_item mi ON ol.menu_item_id = mi.menu_item_id
        ");

        return $this->response->setJSON($query->getResult());
    }
}