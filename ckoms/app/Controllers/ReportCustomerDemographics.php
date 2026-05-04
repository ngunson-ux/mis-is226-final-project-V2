<?php

namespace App\Controllers;

use App\Models\CustomerDemographicsModel;
use CodeIgniter\Controller;

class ReportCustomerDemographics extends BaseController
{
    protected $customerDemographicsModel;

    public function __construct()
    {
        $this->customerDemographicsModel = new CustomerDemographicsModel();
    }

    /**
     * Display Customer Demographics Report
     */
    public function index()
    {
        $year = $this->request->getGet('year');
        $month = $this->request->getGet('month');
        $day = $this->request->getGet('day');

        // Get all demographics data
        $customerDemographics = $this->customerDemographicsModel->getCustomerDemographics($year, $month, $day);
        $ageDistribution = $this->customerDemographicsModel->getAgeDistribution($year);
        $genderDistribution = $this->customerDemographicsModel->getGenderDistribution($year);
        $orderFrequency = $this->customerDemographicsModel->getOrderFrequencyAnalysis($year);

        $data = [
            'pageTitle' => 'Customer Demographics Report',
            'title' => 'Customer Demographics Report',
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'customerDemographics' => $customerDemographics,
            'ageDistribution' => $ageDistribution,
            'genderDistribution' => $genderDistribution,
            'orderFrequency' => $orderFrequency,
        ];

        return view('reports/customer_demographics', $data);
    }

    /**
     * Export report as CSV
     */
    public function exportCsv()
    {
        $year = $this->request->getGet('year');
        $month = $this->request->getGet('month');
        $day = $this->request->getGet('day');

        $customerDemographics = $this->customerDemographicsModel->getCustomerDemographics($year, $month, $day);

        // Prepare CSV content
        $csv = "Customer ID,First Name,Last Name,Email,Gender,Age,City,Total Orders,Total Spending,Average Order Value,Last Order Date\n";

        foreach ($customerDemographics as $row) {
            $csv .= "{$row['customer_id']},\"{$row['first_name']}\",\"{$row['last_name']}\",\"{$row['email_address']}\",";
            $csv .= "\"{$row['gender']}\",{$row['age']},\"{$row['city']}\",{$row['order_count']},";
            $csv .= "{$row['total_spending']},{$row['avg_order_value']},\"{$row['last_order_date']}\"\n";
        }

        $filename = "customer_demographics_" . date('Y-m-d_H-i-s') . ".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $csv;
        exit;
    }
}
