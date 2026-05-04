<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryRestockingFactTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'restocking_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ingredient_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'transaction_type' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'quantity' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'unit_of_measure' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'transaction_date' => [
                'type' => 'DATE',
            ],
            'remarks' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'date_created' => [
                'type' => 'DATETIME',
            ],
            'date_updated' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('restocking_id', true);

        $this->forge->addForeignKey('ingredient_id', 'ingredient', 'ingredient_id', 'CASCADE', 'CASCADE');
     
        $this->forge->createTable('inventory_restocking_fact');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_restocking_fact');
    }
}