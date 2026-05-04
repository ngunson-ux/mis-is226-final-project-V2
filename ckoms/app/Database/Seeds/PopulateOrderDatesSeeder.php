<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class PopulateOrderDatesSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('UPDATE sales_invoice SET order_date = date_created WHERE order_date IS NULL');
        echo "Order dates populated successfully!\n";
    }
}