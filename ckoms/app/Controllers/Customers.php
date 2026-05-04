<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Customers extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT * FROM customer");

        $brandId = $this->request->getCookie("brandId");
        $brandName = $this->request->getCookie("brandName");

        $data = [];
        $data['brandId'] = $brandId;
        $data['brandName'] = $brandName;
        $data['pageTitle'] = "Customer List";
        $data['customers'] = $query->getResult();

        return view('customers_view', $data);
    }
}