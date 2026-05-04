<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBomTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'bom_line_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ingredient_id' => [
                'type' => 'INTEGER',
                'unsigned' => true,
            ],
            'menu_item_id' => [
                'type' => 'INTEGER',
                'unsigned' => true,
            ],
            'qty_required' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'unit_of_measure' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'date_created' => [
                'type' => 'DATETIME',
                'null' => true,
                'default'    => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'date_updated' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

    $this->forge->addKey('bom_line_id', true);

    // temporarily disable FK to avoid error
    $this->forge->addForeignKey('ingredient_id', 'ingredient', 'ingredient_id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('menu_item_id', 'menu_item', 'menu_item_id', 'CASCADE', 'CASCADE');

    $this->forge->addUniqueKey(['menu_item_id', 'ingredient_id']);
    $this->forge->createTable('bom_bridge');
    }

    public function down()
    {
        $this->forge->dropTable('bom_bridge');
    }
}