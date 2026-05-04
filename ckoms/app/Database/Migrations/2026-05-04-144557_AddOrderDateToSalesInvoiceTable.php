<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderDateToSalesInvoiceTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sales_invoice', [
            'order_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'delivery_address',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sales_invoice', 'order_date');
    }
}
