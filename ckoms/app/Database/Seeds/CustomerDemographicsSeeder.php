<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class CustomerDemographicsSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(ROOTPATH . 'misc/customer_demographics_seeder.csv', 'r');
        $header = fgetcsv($file);
        
        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);
            $this->db->table('customer')
                ->where('customer_id', $data['customer_id'])
                ->update(['gender' => $data['gender']]);
        }
        fclose($file);
    }
}
