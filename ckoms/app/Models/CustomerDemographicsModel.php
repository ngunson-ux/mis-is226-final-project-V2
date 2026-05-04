<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerDemographicsModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = [
        'first_name', 'last_name', 'email_address', 'mobile_number',
        'birthday', 'age', 'gender', 'delivery_address', 'city',
        'province', 'postal_code', 'account_status', 'date_registered',
        'created_by', 'updated_by', 'date_created', 'date_updated',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'date_created';
    protected $updatedField = 'date_updated';

    /**
     * Get customer demographics with order statistics
     */
    public function getCustomerDemographics($year = null, $month = null, $day = null)
    {
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
            GROUP_CONCAT(DISTINCT mi.item_name SEPARATOR ", ") as favorite_items,
            MAX(si.date_created) as last_order_date
        ');

        $builder->leftJoin('sales_invoice si', 'c.customer_id = si.customer_id');
        $builder->leftJoin('order_line ol', 'si.sales_invoice_id = ol.sales_invoice_id');
        $builder->leftJoin('menu_item mi', 'ol.menu_item_id = mi.menu_item_id');

        if ($year !== null) {
            $builder->where('YEAR(si.date_created)', $year);
        }
        if ($month !== null && $year !== null) {
            $builder->where('MONTH(si.date_created)', $month);
        }
        if ($day !== null && $month !== null && $year !== null) {
            $builder->where('DAY(si.date_created)', $day);
        }

        $builder->groupBy('c.customer_id');
        $builder->orderBy('total_spending', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get age distribution statistics
     */
    public function getAgeDistribution($year = null)
    {
        $db = \Config\Database::connect();
        $ageRanges = [
            '18-25' => [18, 25],
            '26-35' => [26, 35],
            '36-45' => [36, 45],
            '46-55' => [46, 55],
            '56+' => [56, 150],
        ];

        $results = [];
        foreach ($ageRanges as $range => $ages) {
            $q = $db->table('customer c')
                ->select('COUNT(c.customer_id) as count, "' . $range . '" as age_range')
                ->where('YEAR(CURDATE()) - YEAR(c.birthday) - (DATE_FORMAT(CURDATE(), "%m%d") < DATE_FORMAT(c.birthday, "%m%d")) BETWEEN', $ages[0], $ages[1]);

            if ($year !== null) {
                $q->leftJoin('sales_invoice si', 'c.customer_id = si.customer_id')
                  ->where('YEAR(si.date_created)', $year);
            }

            $results[] = $q->get()->getRowArray();
        }

        return $results;
    }

    /**
     * Get gender distribution statistics
     */
    public function getGenderDistribution($year = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer c');

        $builder->select('
            c.gender,
            COUNT(c.customer_id) as count,
            COUNT(DISTINCT si.sales_invoice_id) as total_orders,
            COALESCE(SUM(si.total_amount), 0) as total_spending
        ');

        $builder->leftJoin('sales_invoice si', 'c.customer_id = si.customer_id');

        if ($year !== null) {
            $builder->where('YEAR(si.date_created)', $year);
        }

        $builder->groupBy('c.gender');
        return $builder->get()->getResultArray();
    }

    /**
     * Get order frequency analysis
     */
    public function getOrderFrequencyAnalysis($year = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer c');

        $builder->select('
            c.customer_id,
            c.first_name,
            c.last_name,
            COUNT(DISTINCT si.sales_invoice_id) as order_count,
            COALESCE(SUM(si.total_amount), 0) as total_spent,
            COALESCE(AVG(si.total_amount), 0) as avg_order_value
        ');

        $builder->leftJoin('sales_invoice si', 'c.customer_id = si.customer_id');

        if ($year !== null) {
            $builder->where('YEAR(si.date_created)', $year);
        }

        $builder->groupBy('c.customer_id');
        $builder->orderBy('order_count', 'DESC');

        return $builder->get()->getResultArray();
    }
}