<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryUsageFactTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'usage_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'order_line_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'ingredient_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'qty_deducted' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'unit_of_measure' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'date_created' => [
                'type' => 'DATETIME',
            ],
            'date_updated' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('usage_id', true);

        // RELATIONSHIP TO ORDER LINE
        $this->forge->addForeignKey('order_line_id', 'order_line', 'order_line_id', 'CASCADE', 'CASCADE');

        // RELATIONSHIP TO INGREDIENT
        $this->forge->addForeignKey('ingredient_id', 'ingredient', 'ingredient_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('inventory_usage_fact');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_usage_fact');
    }
}