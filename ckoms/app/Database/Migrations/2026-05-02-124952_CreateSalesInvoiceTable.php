<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesInvoiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sales_invoice_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'delivery_partner_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'order_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'total_delivery_fee' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'delivery_address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'date_created' => [
                'type' => 'DATETIME',
            ],
            'date_updated' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('sales_invoice_id', true);

        // RELATIONSHIP TO CUSTOMER
        $this->forge->addForeignKey('customer_id', 'customer', 'customer_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('sales_invoice');
    }

    public function down()
    {
        $this->forge->dropTable('sales_invoice');
    }
}