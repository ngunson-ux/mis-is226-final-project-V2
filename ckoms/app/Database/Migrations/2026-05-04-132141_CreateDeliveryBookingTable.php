<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDeliveryBookingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'delivery_booking_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30,
                'primary'        => true,
            ],
            'sales_invoice_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
                'null'           => false,
            ],
            'delivery_partner_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => false,
            ],
            'assigned_area' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
            ],
            'delivery_status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'default'        => 'Pending',
            ],
            'date_created' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'date_updated' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'created_by' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true,
            ],
            'updated_by' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true,
            ],
        ]);
        
        // KEY CHANGE: Changed from 'sales_invoices' to 'sales_invoice' (singular)
        $this->forge->addForeignKey('sales_invoice_id', 'sales_invoice', 'sales_invoice_id', '', 'CASCADE');
        $this->forge->addForeignKey('delivery_partner_id', 'delivery_partners', 'delivery_partner_id', '', 'CASCADE');
        $this->forge->createTable('delivery_bookings');
    }

    public function down()
    {
        $this->forge->dropTable('delivery_bookings');
    }
}