<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DeliveryPartnerSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('delivery_partners')->where('1=1')->delete();
        $records = [
            ['first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'contact_number' => '09171234567', 'vehicle_type' => 'Motorcycle', 'plate_number' => 'ABC-1234', 'availability_status' => 'available', 'assigned_area' => 'Quezon City', 'rating' => 4.80, 'standard_delivery_fee' => 50.00, 'created_by' => 1, 'updated_by' => 1, 'data_created' => '2026-01-01 08:00:00', 'data_updated' => '2026-01-01 08:00:00'],
            ['first_name' => 'Maria', 'last_name' => 'Santos', 'contact_number' => '09182345678', 'vehicle_type' => 'Motorcycle', 'plate_number' => 'DEF-5678', 'availability_status' => 'available', 'assigned_area' => 'Makati', 'rating' => 4.50, 'standard_delivery_fee' => 65.00, 'created_by' => 1, 'updated_by' => 1, 'data_created' => '2026-01-01 08:00:00', 'data_updated' => '2026-01-01 08:00:00'],
            ['first_name' => 'Pedro', 'last_name' => 'Reyes', 'contact_number' => '09193456789', 'vehicle_type' => 'Bicycle', 'plate_number' => 'N/A', 'availability_status' => 'available', 'assigned_area' => 'Mandaluyong', 'rating' => 4.20, 'standard_delivery_fee' => 45.00, 'created_by' => 1, 'updated_by' => 1, 'data_created' => '2026-01-15 08:00:00', 'data_updated' => '2026-01-15 08:00:00'],
            ['first_name' => 'Ana', 'last_name' => 'Garcia', 'contact_number' => '09204567890', 'vehicle_type' => 'Motorcycle', 'plate_number' => 'GHI-9012', 'availability_status' => 'unavailable', 'assigned_area' => 'Pasig', 'rating' => 4.90, 'standard_delivery_fee' => 55.00, 'created_by' => 1, 'updated_by' => 1, 'data_created' => '2026-02-01 08:00:00', 'data_updated' => '2026-02-01 08:00:00'],
            ['first_name' => 'Carlo', 'last_name' => 'Mendoza', 'contact_number' => '09215678901', 'vehicle_type' => 'Motorcycle', 'plate_number' => 'JKL-3456', 'availability_status' => 'available', 'assigned_area' => 'Taguig', 'rating' => 4.60, 'standard_delivery_fee' => 60.00, 'created_by' => 1, 'updated_by' => 1, 'data_created' => '2026-02-15 08:00:00', 'data_updated' => '2026-02-15 08:00:00'],
        ];
        $this->db->table('delivery_partners')->insertBatch($records);
    }
}
