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
     * Get a delivery partner with their assigned orders and order details
     */
    public function getPartnerWithOrders($partnerId)
    {
        $partner = $this->find($partnerId);

        if (!$partner) {
            return null;
        }

        $db = \Config\Database::connect();
        
        // Query to get orders assigned to this delivery partner
        // Including order line items for detailed tracking
        $orders = $db->table('delivery_bookings db')
            ->select('
                db.delivery_booking_id,
                si.sales_invoice_id,
                si.order_date,
                c.first_name,
                c.last_name,
                c.email_address,
                si.total_amount,
                si.delivery_address,
                db.delivery_status,
                db.assigned_area,
                GROUP_CONCAT(
                    CONCAT(mi.item_name, " (x", ol.quantity, " @ ₱", ol.item_price, ")") 
                    SEPARATOR ", "
                ) as ordered_items
            ')
            ->join('sales_invoice si', 'db.sales_invoice_id = si.sales_invoice_id', 'left')
            ->join('customers c', 'si.customer_id = c.customer_id', 'left')
            ->join('order_line ol', 'si.sales_invoice_id = ol.sales_invoice_id', 'left')
            ->join('menu_items mi', 'ol.menu_item_id = mi.menu_item_id', 'left')
            ->where('db.delivery_partner_id', $partnerId)
            ->groupBy('si.sales_invoice_id')
            ->get()
            ->getResultArray();

        return [
            'delivery_partner' => $partner,
            'orders' => $orders,
            'total_orders' => count($orders)
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
                c.mobile_number,
                c.city,
                c.province,
                COUNT(DISTINCT si.sales_invoice_id) as total_orders_from_customer
            ')
            ->join('sales_invoice si', 'db.sales_invoice_id = si.sales_invoice_id', 'left')
            ->join('customers c', 'si.customer_id = c.customer_id', 'left')
            ->where('db.delivery_partner_id', $partnerId)
            ->groupBy('c.customer_id')
            ->get()
            ->getResultArray();

        return [
            'delivery_partner' => $partner,
            'customers_served' => $customers,
            'total_customers' => count($customers)
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