<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrandSeeder extends Seeder
{

private $data = [
    [1, 'Kitchenette', 'Main kitchen brand offering Filipino, Western, and Japanese dishes', 'https://storage.kitchenette.ph/logos/kitchenette.png', 'info@kitchenette.ph', '09171234567', '123 Quezon Ave, Quezon City', 'BL-2024-001', 'active', 'admin', 'admin'],
    [2, 'Lutong Pinoy', 'Authentic Filipino comfort food brand under CloudRave', 'https://storage.cloudrave.ph/logos/lutongpinoy.png', 'lutongpinoy@cloudrave.ph', '09182345678', '123 Quezon Ave, Quezon City', 'BL-2024-002', 'active', 'admin', 'admin'],
    [3, 'WestBite', 'Western-inspired meals including burgers, pasta, and sandwiches', 'https://storage.cloudrave.ph/logos/westbite.png', 'westbite@cloudrave.ph', '09193456789', '123 Quezon Ave, Quezon City', 'BL-2024-003', 'active', 'admin', 'admin'],
    [4, 'Sakura Bento', 'Japanese-inspired dishes including ramen, bento boxes, and sushi rolls', 'https://storage.cloudrave.ph/logos/sakurabento.png', 'sakurabento@cloudrave.ph', '09204567890', '123 Quezon Ave, Quezon City', 'BL-2024-004', 'active', 'admin', 'admin'],
    [5, 'SweetCloud', 'Desserts and sweet treats brand under CloudRave', 'https://storage.cloudrave.ph/logos/sweetcloud.png', 'sweetcloud@cloudrave.ph', '09215678901', '123 Quezon Ave, Quezon City', 'BL-2024-005', 'inactive', 'admin', 'admin'],
];



    public function run()
    {
        $records = array();
        for ($x = 0; $x < count($this->data); $x++) {
            $brand = $this->data[$x];
            $record = [
                'brand_id' => $brand[0],
                'brand_name' => $brand[1],
                'brand_description' => $brand[2],
                'brand_logo_url' => $brand[3],
                'contact_email' => $brand[4],
                'contact_phone' => $brand[5],
                'business_address' => $brand[6],
                'business_license_number' => $brand[7],
                'brand_status' => $brand[8],
                'created_by' => $brand[9],
                'updated_by' => $brand[10],
            ];
            $records[] = $record;
        }
        $this->db->table('brand')->insertBatch($records);
    }
}
