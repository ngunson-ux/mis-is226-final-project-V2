<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerDemographicsModel extends Model
{
    protected $table            = 'customerdemographics';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
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
        'first_name',
        'last_name',
        'email_address',
        'mobile_number',
        'birthday',
        'age',
        'gender',
        'delivery_address',
        'city',
        'province',
        'postal_code',
        'account_status',
        'date_registered',
        'created_by',
        'updated_by',
        'date_created',
        'date_updated',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'date_created';
    protected $updatedField = 'date_updated';

    /**
     * Get customer demographics with order statistics
     * 
     * @param int|null $year Filter by year
     * @param int|null $month Filter by month (1-12)
     * @param int|null $day Filter by day
     * @return array
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
            c.mobile_number,
            c.birthday,
            YEAR(CURDATE()) - YEAR(c.birthday) - (DATE_FORMAT(CURDATE(), "%m%d") < DATE_FORMAT(c.birthday, "%m%d")) as calculated_age,
            c.gender,
            c.city,
            c.province,
            c.account_status,
            COUNT(DISTINCT si.sales_invoice_id) as total_orders,
            COALESCE(SUM(si.total_amount), 0) as total_spending,
            AVG(si.total_amount) as average_order_value,
            MIN(si.date_created) as first_order_date,
            MAX(si.date_created) as last_order_date,
            GROUP_CONCAT(DISTINCT mi.item_name SEPARATOR ", ") as most_ordered_items
        ');

        $builder->leftJoin('sales_invoice si', 'c.customer_id = si.customer_id');
        $builder->leftJoin('order_line ol', 'si.sales_invoice_id = ol.sales_invoice_id');
        $builder->leftJoin('menu_item mi', 'ol.menu_item_id = mi.menu_item_id');

        // Apply date filters
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
     * 
     * @param int|null $year Filter by year
     * @return array
     */
    public function getAgeDistribution($year = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('customer c');

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
     * 
     * @param int|null $year Filter by year
     * @return array
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
        $builder->orderBy('count', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get customer order frequency analysis
     * 
     * @param int|null $year Filter by year
     * @return array
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
            AVG(si.total_amount) as avg_order_value,
            CASE 
                WHEN COUNT(DISTINCT si.sales_invoice_id) >= 10 THEN "High"
                WHEN COUNT(DISTINCT si.sales_invoice_id) >= 5 THEN "Medium"
                ELSE "Low"
            END as frequency_category
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
