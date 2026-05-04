<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class CloudKitchenHome extends BaseController
{

    const PAGE_TITLE = 'Welcome to Cloud Kitchen of ';

    public function getIndex()
    {
        if (!empty($this->request->getGet('brandId'))) {
            $brandId = $this->request->getGet('brandId');
            $brandName = $this->request->getGet('brandName');
            log_message('info', "Received brand ID: " . $brandId); // Debugging line to check if brand ID is received correctly
            
            $this->response->setCookie('brandId', $brandId); // always pass brand ID in cookie for future use
            $brandName = $this->request->getGet('brandName') ?? 'ACME Corp'; // Placeholder for actual brand name retrieval logic based on brand ID
            $this->response->setCookie('brandName', $brandName); // always pass brand name in cookie for future use
            // TODO: Perform get cloud brand details or other actions with $brandId
            $data = [];
            $data['brandId'] = $brandId;
            $data['brandName'] = $brandName;
            $data['pageTitle'] = self::PAGE_TITLE . $brandName;
            return view('cloud-kitchen-home', $data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function deliveryPartners()
    {
        $brandId = $this->request->getCookie("brandId");
        $brandName = $this->request->getCookie("brandName");

        $data = [];
        $data['brandId'] = $brandId;
        $data['brandName'] = $brandName;
        $data['pageTitle'] = "Delivery Partners";
        return view('delivery_partners', $data); 
    }

    public function reportsHome()
    {

    $brandId = $this->request->getGet('brandId');
        $brandId = $this->request->getCookie("brandId");
        $brandName = $this->request->getCookie("brandName");

        $data = [];
        $data['brandId'] = $brandId;
        $data['brandName'] = $brandName;
        $data['pageTitle'] = "Reports Home - " . $brandName;
        return view('reports-home', $data);
    }

}
