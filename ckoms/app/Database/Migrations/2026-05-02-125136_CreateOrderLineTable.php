<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderLineTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_line_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'sales_invoice_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'menu_item_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'unit_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'line_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('order_line_id', true);

        // RELATIONSHIPS
        $this->forge->addForeignKey('sales_invoice_id', 'sales_invoice', 'sales_invoice_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('menu_item_id', 'menu_item', 'menu_item_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('order_line');
    }

    public function down()
    {
        $this->forge->dropTable('order_line');
    }
}