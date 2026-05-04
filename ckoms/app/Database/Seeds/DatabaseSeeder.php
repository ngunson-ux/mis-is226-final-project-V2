<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->call('BrandSeeder');
        $this->call('CustomerSeeder');
        $this->call('MenuItemSeeder');
        $this->call('IngredientSeeder');
        $this->call('SalesInvoiceSeeder');
        $this->call('OrderLineSeeder');
		$this->call('DeliveryPartnerSeeder');
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }
}