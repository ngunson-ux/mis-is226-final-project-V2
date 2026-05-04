<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDeliveryPartnerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'delivery_partner_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'contact_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'vehicle_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'plate_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'availability_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'available',
            ],
            'assigned_area' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'rating' => [
                'type'       => 'DECIMAL',
                'constraint' => '3,2',
                'default'    => 0.00,
            ],
            'total_deliveries' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'date_created' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'date_updated' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('delivery_partner_id', true);
        $this->forge->createTable('delivery_partners');
    }

    public function down()
    {
        $this->forge->dropTable('delivery_partners');
    }
}