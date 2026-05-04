<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBrandTable extends Migration
{
/*
brand_id (primary key), brand_name, brand_description, brand_logo_url, contact_email, contact_phone, business_address, business_license_number, brand_status (active/inactive), created_by, updated_by, date_created, date_updated

*/

    public function up()
    {
$this->forge->addField([
            'brand_id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'brand_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'brand_description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'brand_logo_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],               
            'contact_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],   
            'contact_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],   
            'business_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],   
            'business_license_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'brand_status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',                
                'null'       => true,
            ],
            'date_created' => [
                'type'       => 'TIMESTAMP',
                'null'       => false,
            ],
            'date_updated' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('brand_id');
        $this->forge->addUniqueKey('brand_name');
        $this->forge->createTable('brand');
    }

    public function down()
    {
        $this->forge->dropTable('brand');
    }
}
