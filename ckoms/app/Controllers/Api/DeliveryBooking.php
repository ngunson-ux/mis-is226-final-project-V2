<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DeliveryBookingModel;
use App\Models\DeliveryPartnerModel;
use App\Models\SalesInvoiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class DeliveryBooking extends BaseController
{
    use ResponseTrait;

    private DeliveryBookingModel $model;
    private DeliveryPartnerModel $partnerModel;
    private SalesInvoiceModel $invoiceModel;

    public function __construct()
    {
        $this->model = model(DeliveryBookingModel::class);
        $this->partnerModel = model(DeliveryPartnerModel::class);
        $this->invoiceModel = model(SalesInvoiceModel::class);
    }

    // Get all bookings or by status
    public function index(): ResponseInterface
    {
        $status = $this->request->getGet('status');

        if ($status) {
            return $this->respond($this->model->getBookingsByStatus($status));
        }

        return $this->respond($this->model->findAll());
    }

    // Get specific booking with details
    public function show($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('Booking ID is required');
        }

        $booking = $this->model->getBookingWithDetails($id);

        if (!$booking) {
            return $this->failNotFound('Delivery booking not found');
        }

        return $this->respond($booking);
    }

    // Create delivery booking
    public function create(): ResponseInterface
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->failValidationErrors('No input data received');
        }

        // Validate required fields
        if (empty($data['sales_invoice_id']) || empty($data['delivery_partner_id'])) {
            return $this->failValidationErrors('sales_invoice_id and delivery_partner_id are required');
        }

        // Check if invoice and partner exist
        $invoice = $this->invoiceModel->find($data['sales_invoice_id']);
        if (!$invoice) {
            return $this->failNotFound('Sales invoice not found');
        }

        $partner = $this->partnerModel->find($data['delivery_partner_id']);
        if (!$partner) {
            return $this->failNotFound('Delivery partner not found');
        }

        // Check partner availability
        if ($partner['availability_status'] !== 'Available') {
            return $this->failValidationErrors('Delivery partner is not available');
        }

        // Generate booking ID
        $data['delivery_booking_id'] = 'DB' . date('YmdHis') . rand(100, 999);
        $data['delivery_status'] = $data['delivery_status'] ?? 'Pending';
        $data['assigned_area'] = $data['assigned_area'] ?? $partner['assigned_area'];

        $inserted = $this->model->insert($data);

        if (!$inserted) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'Delivery booking created successfully',
            'id' => $data['delivery_booking_id']
        ]);
    }

    // Update booking status
    public function updateStatus($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('Booking ID is required');
        }

        $booking = $this->model->find($id);
        if (!$booking) {
            return $this->failNotFound('Delivery booking not found');
        }

        $data = $this->request->getJSON(true);
        $status = $data['delivery_status'] ?? null;

        if (!$status) {
            return $this->failValidationErrors('delivery_status is required');
        }

        if (!$this->model->update($id, ['delivery_status' => $status])) {
            return $this->failServerError('Failed to update booking status');
        }

        return $this->respond([
            'message' => 'Delivery booking status updated successfully',
            'status' => $status
        ]);
    }

    // Delete booking
    public function delete($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('Booking ID is required');
        }

        $booking = $this->model->find($id);
        if (!$booking) {
            return $this->failNotFound('Delivery booking not found');
        }

        if (!$this->model->delete($id)) {
            return $this->failServerError('Failed to delete booking');
        }

        return $this->respondDeleted([
            'message' => 'Delivery booking deleted successfully',
            'id' => $id
        ]);
    }
}