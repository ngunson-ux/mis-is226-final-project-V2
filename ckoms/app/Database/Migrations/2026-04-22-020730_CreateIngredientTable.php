<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIngredientTable extends Migration
{
/*
ingredient_id	name	brand	description	qty_purchased	qty_remaining	unit_of_measure	category	allergen_flag	created_by	updated_by	date_created	date_updated

*/

    public function up()
    {
$this->forge->addField([
            'ingredient_id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'brand_id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'brand' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],               
            'qty_purchased' => [
                'type'       => 'INTEGER',
                'unsigned'   => true,
                'null'       => false,
            ],   
            'qty_purchased' => [
                'type'       => 'NUMERIC',
                'unsigned'   => true,
                'null'       => false,
            ],   
            'qty_remaining' => [
                'type'       => 'NUMERIC',
                'unsigned'   => true,
                'null'       => false,
            ],   
            'unit_of_measure' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'allergen_flag' => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
                'null'       => false,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',                
                'null'       => true,
            ],
            'date_created' => [
                'type'       => 'TIMESTAMP',
                'null'       => false,
                'default'    => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'date_updated' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('ingredient_id');
        $this->forge->addUniqueKey(['brand_id', 'name']);
        $this->forge->addForeignKey('brand_id', 'brand', 'brand_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ingredient');
    }

    public function down()
    {
        $this->forge->dropTable('ingredient');
    }
}
