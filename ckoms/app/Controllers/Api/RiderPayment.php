<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Transformers\RiderPaymentTransformer;
use App\Models\RiderPaymentModel;

class RiderPayment extends BaseController
{
    use ResponseTrait;

    private $model;

    public function __construct(?RiderPaymentModel $model = null)
    {
        $this->model = $model ?? model(RiderPaymentModel::class);
    }

    public function getIndex(?int $id = null): ResponseInterface
    {
        $transformer = new RiderPaymentTransformer();

        if ($id !== null) {
            $payment = $this->model->find($id);
            if ($payment === null) {
                return $this->failNotFound('Rider payment not found');
            }
            return $this->respond($transformer->toArray($payment), 200);
        }

        $payments = $this->model->findAll();
        $data = [];
        foreach ($payments as $payment) {
            $data[] = $transformer->toArray($payment);
        }
        return $this->respond($data, 200);
    }

    public function create(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        $payment = $this->model->find($this->model->getInsertID());
        $transformer = new RiderPaymentTransformer();
        return $this->respondCreated($transformer->toArray($payment));
    }

    public function update(int $id): ResponseInterface
    {
        $payment = $this->model->find($id);
        if ($payment === null) {
            return $this->failNotFound('Rider payment not found');
        }
        $data = $this->request->getJSON(true);
        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        $transformer = new RiderPaymentTransformer();
        return $this->respond($transformer->toArray($this->model->find($id)), 200);
    }

    public function delete(int $id): ResponseInterface
    {
        $payment = $this->model->find($id);
        if ($payment === null) {
            return $this->failNotFound('Rider payment not found');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Rider payment deleted successfully']);
    }
}
