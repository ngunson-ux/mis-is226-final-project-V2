<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Transformers\DeliveryExpenseTransformer;
use App\Models\DeliveryExpenseModel;

class DeliveryExpense extends BaseController
{
    use ResponseTrait;

    private $model;

    public function __construct(?DeliveryExpenseModel $model = null)
    {
        $this->model = $model ?? model(DeliveryExpenseModel::class);
    }

    public function getIndex(?int $id = null): ResponseInterface
    {
        $transformer = new DeliveryExpenseTransformer();

        if ($id !== null) {
            $expense = $this->model->find($id);
            if ($expense === null) {
                return $this->failNotFound('Delivery expense not found');
            }
            return $this->respond($transformer->toArray($expense), 200);
        }

        $expenses = $this->model->findAll();
        $data = [];
        foreach ($expenses as $expense) {
            $data[] = $transformer->toArray($expense);
        }
        return $this->respond($data, 200);
    }

    public function create(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        $expense = $this->model->find($this->model->getInsertID());
        $transformer = new DeliveryExpenseTransformer();
        return $this->respondCreated($transformer->toArray($expense));
    }

    public function update(int $id): ResponseInterface
    {
        $expense = $this->model->find($id);
        if ($expense === null) {
            return $this->failNotFound('Delivery expense not found');
        }
        $data = $this->request->getJSON(true);
        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        $transformer = new DeliveryExpenseTransformer();
        return $this->respond($transformer->toArray($this->model->find($id)), 200);
    }

    public function delete(int $id): ResponseInterface
    {
        $expense = $this->model->find($id);
        if ($expense === null) {
            return $this->failNotFound('Delivery expense not found');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Delivery expense deleted successfully']);
    }
}
