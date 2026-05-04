<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Transformers\BrandTransformer;
use App\Models\BrandModel;

class Brand extends BaseController
{

    use ResponseTrait;

    private $model;

    public function __construct(?BrandModel $model = null)
    {
        $this->model = $model ?? model(BrandModel::class);
    }

    // This method will be called when the /brand route is accessed with a GET request.
    public function getIndex(?int $id = null): ResponseInterface
    {
        $transformer = new BrandTransformer();
        $brand = null;
        $brand_name = $this->request->getGet('brand_name');
        if ($id !== null) {
            $brand = $this->model->find($id);
            if ($brand === null) {
                return $this->failNotFound('Brand not found');
            }
            return $this->respond($transformer->toArray($brand), 200);
        } else if ($brand_name !== null) {
            $brand = $this->model->where('brand_name', $brand_name)->findAll();
        } else {
            $brand = $this->model->findAll();
        }

        $data = [];
        foreach ($brand as $brand) { 
            $data[] = $transformer->toArray($brand);
        }

        return $this->respond($data, 200);
        
    }

    public function create(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->insert($data)){
            return $this->failValidationError($this->model->errors());
        }

        $brand = $this->model->find($this->model->getInsertID());
        $transformer = new BrandTransformer();
        return $this->respondCreated($transformer->toArray($brand));
    }

    public function update(int $id): ResponseInterface
    {
        $brand = $this->model->find($id);
        if ($brand ===null) {
            return $this->failNotFound('Brand not found');
        }
        $data = $this->request->getJSON(true);
        if (!$this->model->update($id, $data)){
            return $this->failValidationErrors($this->model->errors());
        }

        $transformer = new BrandTransformer();
        return $this->respond($transformer->toArray($this->model->find($id)), 200);

    }

    public function delete(int $id): ResponseInterface
    {
        $brand = $this->model->find($id);
        if ($brand === null){
            return $this->failNotFound('Brand not found');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Brand deleted successfully']);

    }

}
