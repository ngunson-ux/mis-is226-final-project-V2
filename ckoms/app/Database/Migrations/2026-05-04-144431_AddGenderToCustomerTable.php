<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGenderToCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customer', [
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'birthday',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('customer', 'gender');
    }
}
