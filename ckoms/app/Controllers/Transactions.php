<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Transactions extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        // SALES INVOICE (HEADER)
        $invoices = $db->query("
            SELECT 
                si.*,
                c.first_name,
                c.last_name
            FROM sales_invoice si
            JOIN customer c ON si.customer_id = c.customer_id
        ")->getResult();

        // ORDER LINE (DETAILS)
        $orderLines = $db->query("
            SELECT 
                ol.*,
                mi.item_name
            FROM order_line ol
            JOIN menu_item mi ON ol.menu_item_id = mi.menu_item_id
        ")->getResult();
        
        $brandId = $this->request->getCookie("brandId");
        $brandName = $this->request->getCookie("brandName");

        $data = [];
        $data['brandId'] = $brandId;
        $data['brandName'] = $brandName;
        $data['pageTitle'] = "Sales Transactions";
        $data['invoices'] = $invoices;
        $data['orderLines'] = $orderLines;

        return view('transactions_view', $data);
    }
}