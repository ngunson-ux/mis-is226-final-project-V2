<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeliveryPartnerIdToSalesInvoiceTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sales_invoice', [
            'delivery_partner_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'customer_id',
            ],
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('delivery_partner_id', 'delivery_partners', 'delivery_partner_id', '', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropForeignKey('sales_invoice', 'sales_invoice_delivery_partner_id_foreign');
        $this->forge->dropColumn('sales_invoice', 'delivery_partner_id');
    }
}
