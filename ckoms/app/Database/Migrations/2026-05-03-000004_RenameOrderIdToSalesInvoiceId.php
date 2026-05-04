<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameOrderIdToSalesInvoiceId extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('delivery_expense', 'order_id');
        $this->forge->addColumn('delivery_expense', [
            'sales_invoice_id' => [
                'type'     => 'INTEGER',
                'unsigned' => true,
                'null'     => false,
                'after'    => 'delivery_partner_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('delivery_expense', 'sales_invoice_id');
        $this->forge->addColumn('delivery_expense', [
            'order_id' => [
                'type'     => 'INTEGER',
                'unsigned' => true,
                'null'     => false,
                'after'    => 'delivery_partner_id',
            ],
        ]);
    }
}
