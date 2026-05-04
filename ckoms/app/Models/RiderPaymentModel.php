<?php

namespace App\Models;

use CodeIgniter\Model;

class RiderPaymentModel extends Model
{
    protected $table            = 'rider_payment';
    protected $primaryKey       = 'payment_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'delivery_partner_id',
        'payment_amount',
        'payment_method',
        'payment_status',
        'created_by',
        'updated_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';
}
