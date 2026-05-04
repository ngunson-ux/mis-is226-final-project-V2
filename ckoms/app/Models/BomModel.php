<?php

namespace App\Models;

use CodeIgniter\Model;

class BomModel extends Model
{
    protected $table = 'bom_bridge';
    protected $primaryKey = 'bom_line_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;   
    protected $allowedFields = [
        'ingredient_id',
        'menu_item_id',
        'qty_required',
        'unit_of_measure',
        'created_by',
        'updated_by',
        'date_created',
        'date_updated',
    ];

}