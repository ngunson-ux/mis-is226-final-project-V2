<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryExpenseModel extends Model
{
    protected $table            = 'delivery_expense';
    protected $primaryKey       = 'expense_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'delivery_partner_id',
        'sales_invoice_id',
        'delivery_fee',
        'expense_date',
        'created_by',
        'updated_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';
}
