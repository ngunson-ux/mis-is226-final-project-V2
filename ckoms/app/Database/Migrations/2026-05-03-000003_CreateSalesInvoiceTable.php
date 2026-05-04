<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesInvoiceTableV2 extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'sales_invoice_id' => [
        //         'type'           => 'INTEGER',
        //         'unsigned'       => true,
        //         'auto_increment' => true,
        //     ],
        //     'customer_id' => [
        //         'type'     => 'INTEGER',
        //         'unsigned' => true,
        //         'null'     => false,
        //     ],
        //     'order_status' => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => '50',
        //         'null'       => false,
        //     ],
        //     'total_amount' => [
        //         'type'       => 'DECIMAL',
        //         'constraint' => '10,2',
        //         'null'       => false,
        //     ],
        //     'total_delivery_fee' => [
        //         'type'       => 'DECIMAL',
        //         'constraint' => '10,2',
        //         'null'       => false,
        //     ],
        //     'delivery_address' => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => '255',
        //         'null'       => false,
        //     ],
        //     'date_created' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        //     'date_updated' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        // ]);

        // $this->forge->addPrimaryKey('sales_invoice_id');
        // $this->forge->createTable('sales_invoice');
    }

    public function down()
    {
        // $this->forge->dropTable('sales_invoice');
    }
}
