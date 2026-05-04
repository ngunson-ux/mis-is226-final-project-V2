<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeliveryPartnerIdToSalesInvoiceTable extends Migration
{
    public function up()
    {
        $fields = $this->db->getFieldData('sales_invoice');
        $fieldNames = array_column($fields, 'name');
        
        if (!in_array('delivery_partner_id', $fieldNames)) {
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
    }

    public function down()
    {
        $fields = $this->db->getFieldData('sales_invoice');
        $fieldNames = array_column($fields, 'name');
        
        if (in_array('delivery_partner_id', $fieldNames)) {
            // Try to drop foreign key first
            try {
                $this->forge->dropForeignKey('sales_invoice', 'sales_invoice_delivery_partner_id_foreign');
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }
            
            $this->forge->dropColumn('sales_invoice', 'delivery_partner_id');
        }
    }
}
