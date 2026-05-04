<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrderLineSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(WRITEPATH . '../../misc/order_line.csv', 'r');

        $data = [];
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = [
                'order_line_id'    => $row[0],
                'sales_invoice_id' => $row[1],
                'menu_item_id'     => $row[2],
                'quantity'         => $row[3],
                'unit_price'       => $row[4],
                'line_total'       => $row[5],
            ];
        }

        fclose($file);

        $this->db->table('order_line')->insertBatch($data);
    }
}