<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SalesInvoiceSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(WRITEPATH . '../../misc/sales_invoice.csv', 'r');

        $data = [];
        $header = fgetcsv($file); // skip header

        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = [
                'sales_invoice_id'   => $row[0],
                'customer_id'        => $row[1],
                'delivery_partner_id'=> $row[2],
                'order_status'       => $row[3],
                'total_amount'       => $row[4],
                'total_delivery_fee' => $row[5],
                'delivery_address'   => $row[6],
                'date_created'       => $row[7],
                'date_updated'       => $row[8],
            ];
        }

        fclose($file);

        $this->db->table('sales_invoice')->insertBatch($data);
    }
}