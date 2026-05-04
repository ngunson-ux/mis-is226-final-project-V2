<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function getIndex()
    {
        //return view('home');
        return redirect()->to('/manage-brand');
    }

    public function postIndex()
    {
        $brandName = $this->request->getPost('brandName');
        log_message('info', "Received brand name: " . $brandName); // Debugging line to check if brand name is received correctly
        $brandId = 123; // Placeholder for actual brand ID retrieval logic
        return redirect()->to('/cloud-kitchen-home?brandId=' . $brandId);
    }
}
