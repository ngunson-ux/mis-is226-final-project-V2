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

    /**
     * Get a delivery partner with their assigned orders
     */
    public function getPartnerWithOrders($partnerId)
    {
        $partner = $this->find($partnerId);

        if (!$partner) {
            return null;
        }

        $db = \Config\Database::connect();
        
        // Query to get orders assigned to this delivery partner
        $orders = $db->table('delivery_bookings db')
            ->select('
                si.sales_invoice_id,
                c.first_name,
                c.last_name,
                si.total_amount,
                db.delivery_status
            ')
            ->join('sales_invoices si', 'db.sales_invoice_id = si.sales_invoice_id')
            ->join('customers c', 'si.customer_id = c.customer_id')
            ->where('db.delivery_partner_id', $partnerId)
            ->get()
            ->getResultArray();

        return [
            'delivery_partner' => $partner,
            'orders' => $orders
        ];
    }

    /**
     * Get a delivery partner with customers they have served
     */
    public function getPartnerWithCustomers($partnerId)
    {
        $partner = $this->find($partnerId);

        if (!$partner) {
            return null;
        }

        $db = \Config\Database::connect();
        
        // Query to get unique customers served by this delivery partner
        $customers = $db->table('delivery_bookings db')
            ->distinct()
            ->select('
                c.customer_id,
                c.first_name,
                c.last_name,
                c.email_address,
                c.city
            ')
            ->join('sales_invoices si', 'db.sales_invoice_id = si.sales_invoice_id')
            ->join('customers c', 'si.customer_id = c.customer_id')
            ->where('db.delivery_partner_id', $partnerId)
            ->get()
            ->getResultArray();

        return [
            'delivery_partner' => $partner,
            'customers_served' => $customers
        ];
    }

    /**
     * Update availability status of a delivery partner
     */
    public function updateAvailability($partnerId, $status)
    {
        return $this->update($partnerId, ['availability_status' => $status]);
    }
}
