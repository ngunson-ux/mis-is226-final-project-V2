<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderDateToSalesInvoiceTable extends Migration
{
    public function up()
    {
        $fields = $this->db->getFieldData('sales_invoice');
        $fieldNames = array_column($fields, 'name');
        
        if (!in_array('order_date', $fieldNames)) {
            $this->forge->addColumn('sales_invoice', [
                'order_date' => [
                    'type' => 'DATE',
                    'null' => true,
                    'after' => 'delivery_address',
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldData('sales_invoice');
        $fieldNames = array_column($fields, 'name');
        
        if (in_array('order_date', $fieldNames)) {
            $this->forge->dropColumn('sales_invoice', 'order_date');
        }
    }
}
