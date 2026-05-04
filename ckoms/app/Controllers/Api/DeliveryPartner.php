<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DeliveryPartnerModel;
use CodeIgniter\HTTP\ResponseInterface;

class DeliveryPartner extends BaseController
{
    use ResponseTrait;

    private DeliveryPartnerModel $model;

    public function __construct()
    {
        $this->model = model(DeliveryPartnerModel::class);
    }

    public function index($id = null): ResponseInterface
    {
        $status = $this->request->getGet('status');
        $area   = $this->request->getGet('area');

        if ($id !== null) {
            $partner = $this->model->find($id);

            if (!$partner) {
                return $this->failNotFound('Delivery partner not found');
            }

            return $this->respond($partner);
        }

        $query = $this->model;

        if ($status) {
            $query = $query->where('availability_status', $status);
        }

        if ($area) {
            $query = $query->where('assigned_area', $area);
        }

        return $this->respond($query->findAll());
    }

    public function getOrders($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('Partner ID is required');
        }

        $partner = $this->model->find($id);

        if (!$partner) {
            return $this->failNotFound('Delivery partner not found');
        }

        $partnerWithOrders = $this->model->getPartnerWithOrders($id);

        return $this->respond($partnerWithOrders);
    }

    public function getCustomers($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('Partner ID is required');
        }

        $partner = $this->model->find($id);

        if (!$partner) {
            return $this->failNotFound('Delivery partner not found');
        }

        $partnerWithCustomers = $this->model->getPartnerWithCustomers($id);

        return $this->respond($partnerWithCustomers);
    }

    public function create(): ResponseInterface
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->failValidationErrors('No input data received');
        }

        $inserted = $this->model->insert($data);

        if (!$inserted) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'Delivery partner created successfully',
            'id' => $inserted
        ]);
    }

    public function update($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('ID is required');
        }

        $partner = $this->model->find($id);

        if (!$partner) {
            return $this->failNotFound('Delivery partner not found');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Delivery partner updated successfully'
        ]);
    }

    public function delete($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('ID is required');
        }

        $partner = $this->model->find($id);

        if (!$partner) {
            return $this->failNotFound('Delivery partner not found');
        }

        $result = $this->model->delete($id);

        if (!$result) {
            return $this->failServerError('Failed to delete record');
        }

        return $this->respondDeleted([
            'message' => 'Delivery partner deleted successfully',
            'id' => $id
        ]);
    }

    public function updateAvailability($id = null): ResponseInterface
    {
        if (!$id) {
            return $this->failValidationErrors('ID is required');
        }

        $partner = $this->model->find($id);

        if (!$partner) {
            return $this->failNotFound('Delivery partner not found');
        }

        $data = $this->request->getJSON(true);
        $status = $data['availability_status'] ?? null;

        if (!$status) {
            return $this->failValidationErrors('availability_status is required');
        }

        if (!$this->model->updateAvailability($id, $status)) {
            return $this->failServerError('Failed to update availability');
        }

        return $this->respond([
            'message' => 'Availability status updated successfully',
            'status' => $status
        ]);
    }
}
