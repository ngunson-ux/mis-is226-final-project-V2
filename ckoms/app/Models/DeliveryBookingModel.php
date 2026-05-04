<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryBookingModel extends Model
{
    protected $table = 'delivery_bookings';
    protected $primaryKey = 'delivery_booking_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'sales_invoice_id',
        'delivery_partner_id',
        'assigned_area',
        'delivery_status',
        'created_by',
        'updated_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';

    // Get booking with order and partner details
    public function getBookingWithDetails($bookingId)
    {
        return $this->select('delivery_bookings.*, 
                            sales_invoices.order_date, 
                            sales_invoices.total_amount,
                            customers.first_name, 
                            customers.last_name,
                            customers.email_address,
                            delivery_partners.first_name as partner_first_name,
                            delivery_partners.last_name as partner_last_name')
            ->join('sales_invoices', 'delivery_bookings.sales_invoice_id = sales_invoices.sales_invoice_id')
            ->join('customers', 'sales_invoices.customer_id = customers.customer_id')
            ->join('delivery_partners', 'delivery_bookings.delivery_partner_id = delivery_partners.delivery_partner_id')
            ->where('delivery_bookings.delivery_booking_id', $bookingId)
            ->first();
    }

    // Get all bookings by status
    public function getBookingsByStatus($status)
    {
        return $this->where('delivery_status', $status)
            ->orderBy('date_created', 'DESC')
            ->findAll();
    }
}