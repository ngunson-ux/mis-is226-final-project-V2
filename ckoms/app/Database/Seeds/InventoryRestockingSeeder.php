<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InventoryRestockingSeeder extends Seeder
{
    public function run()
    {
        $ingredients = $this->db->table('ingredient')->get()->getResultArray();

        $data = [];

        foreach ($ingredients as $ingredient) {
            $data[] = [
                'ingredient_id'     => $ingredient['ingredient_id'],
                'transaction_type'  => 'RESTOCK',
                'quantity'          => $ingredient['qty_remaining'],
                'unit_of_measure'   => $ingredient['unit_of_measure'],
                'transaction_date'  => '2026-05-01',
                'remarks'           => 'Initial restock balance based on current inventory',
                'date_created'      => '2026-05-01 08:00:00',
                'date_updated'      => '2026-05-01 08:00:00',
            ];
        }

        if (!empty($data)) {
            $this->db->table('inventory_restocking_fact')->insertBatch($data);
        }
    }
}