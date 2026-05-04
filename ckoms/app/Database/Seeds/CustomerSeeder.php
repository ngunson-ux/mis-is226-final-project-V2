<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(WRITEPATH . '../../misc/customer.csv', 'r');

        $data = [];
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = [
                'customer_id' => $row[0],
                'first_name' => $row[1],
                'last_name' => $row[2],
                'email_address' => $row[3],
                'mobile_number' => $row[4],
                'birthday' => $row[5],
                'age' => $row[6],
                'delivery_address' => $row[7],
                'city' => $row[8],
                'province' => $row[9],
                'postal_code' => $row[10],
                'account_status' => $row[11],
                'date_registered' => $row[12],
                'created_by' => $row[13],
            ];
        }

        fclose($file);

        $this->db->table('customer')->insertBatch($data);
    }
}