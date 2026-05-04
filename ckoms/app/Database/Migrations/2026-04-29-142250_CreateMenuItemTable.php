<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuItemTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_item_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'brand_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'menu_category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'availability_status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'Available',
            ],
            'preparation_time' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'max_orderable_quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'allergen_flag' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
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

        $this->forge->addKey('menu_item_id', true);
        $this->forge->addForeignKey('brand_id', 'brand', 'brand_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_item');
    }

    public function down()
    {
        $this->forge->dropTable('menu_item');
    }
}