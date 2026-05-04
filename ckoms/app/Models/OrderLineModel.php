<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderLineModel extends Model
{
    protected $table = 'order_line';
    protected $primaryKey = 'order_line_id';

    protected $useAutoIncrement = false; 
    protected $returnType = 'array';

    protected $allowedFields = [
        'order_line_id',
        'sales_invoice_id',
        'menu_item_id',
        'quantity',
        'unit_price',
        'line_total'
    ];

    protected $useTimestamps = false;
}