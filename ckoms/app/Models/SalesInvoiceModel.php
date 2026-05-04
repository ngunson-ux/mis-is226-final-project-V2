<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesInvoiceModel extends Model
{
    protected $table            = 'sales_invoice';
    protected $primaryKey       = 'sales_invoice_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'customer_id',
        'order_status',
        'total_amount',
        'total_delivery_fee',
        'delivery_address',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';
}
