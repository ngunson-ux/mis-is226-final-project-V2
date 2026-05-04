<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuItemModel extends Model
{
    protected $table = 'menu_item';
    protected $primaryKey = 'menu_item_id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'brand_id',
        'item_name',
        'description',
        'menu_category',
        'price',
        'availability_status',
        'preparation_time',
        'max_orderable_quantity',
        'allergen_flag',
        'created_by',
        'updated_by',
        'date_created',
        'date_updated'
    ];

    protected $useTimestamps = false;

    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';
}