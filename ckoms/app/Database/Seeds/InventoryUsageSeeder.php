<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InventoryUsageSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        $orderLines = $db->table('order_line')->get()->getResultArray();

        foreach ($orderLines as $order) {

            // Get BOM ingredients for this menu item
            $bomItems = $db->table('bom_bridge')
                ->where('menu_item_id', $order['menu_item_id'])
                ->get()
                ->getResultArray();

            foreach ($bomItems as $bom) {

                // Compute actual usage
                $usageQty = $order['quantity'] * $bom['quantity_required'];

                $db->table('inventory_restocking_fact')->insert([
                    'ingredient_id'   => $bom['ingredient_id'],
                    'transaction_type'=> 'USAGE',
                    'quantity'        => $usageQty,
                    'transaction_date'=> date('Y-m-d'),
                    'date_created'    => date('Y-m-d H:i:s'),
                    'date_updated'    => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}