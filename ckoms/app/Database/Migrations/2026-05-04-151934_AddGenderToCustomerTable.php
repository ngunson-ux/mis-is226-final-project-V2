<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGenderToCustomerTable extends Migration
{
    public function up()
    {
        $fields = $this->db->getFieldData('customer');
        $fieldNames = array_column($fields, 'name');
        
        if (!in_array('gender', $fieldNames)) {
            $this->forge->addColumn('customer', [
                'gender' => [
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                    'null' => true,
                    'after' => 'birthday',
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldData('customer');
        $fieldNames = array_column($fields, 'name');
        
        if (in_array('gender', $fieldNames)) {
            $this->forge->dropColumn('customer', 'gender');
        }
    }
}
