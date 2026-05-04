<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderLineTableV2 extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'order_line_id' => [
        //         'type'           => 'INTEGER',
        //         'unsigned'       => true,
        //         'auto_increment' => true,
        //     ],
        //     'menu_item_id' => [
        //         'type'     => 'INTEGER',
        //         'unsigned' => true,
        //         'null'     => false,
        //     ],
        //     'sales_invoice_id' => [
        //         'type'     => 'INTEGER',
        //         'unsigned' => true,
        //         'null'     => false,
        //     ],
        //     'quantity' => [
        //         'type'     => 'INT',
        //         'null'     => false,
        //     ],
        //     'unit_price' => [
        //         'type'       => 'DECIMAL',
        //         'constraint' => '10,2',
        //         'null'       => false,
        //     ],
        //     'line_total' => [
        //         'type'       => 'DECIMAL',
        //         'constraint' => '10,2',
        //         'null'       => false,
        //     ],
        // ]);

        // $this->forge->addPrimaryKey('order_line_id');
        // $this->forge->createTable('order_line');
    }

    public function down()
    {
        // $this->forge->dropTable('order_line');
    }
}
