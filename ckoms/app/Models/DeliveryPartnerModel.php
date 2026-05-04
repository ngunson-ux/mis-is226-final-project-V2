<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryPartnerModel extends Model
{
    protected $table = 'delivery_partners';
    protected $primaryKey = 'delivery_partner_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'contact_number',
        'vehicle_type',
        'plate_number',
        'availability_status',
        'assigned_area',
        'rating',
        'total_deliveries',
        'created_by',
        'updated_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';
}