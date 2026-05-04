<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\MenuItemModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Transformers\IngredientTransformer;
use App\Models\IngredientModel;
use App\Transformers\BomTransformer;

class Ingredients extends BaseController
{

    use ResponseTrait;

    private IngredientModel $model;

    public function __construct(?IngredientModel $model = null)
    {
        $this->model = $model ?? model(IngredientModel::class);
    }

    // This method will be called when the /brands/{brandId}/ingredients route is accessed with a GET request.
    public function getIndex(int $brandId, ?int $ingredientId = null): ResponseInterface
    {
        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');
    
        $transformer = new IngredientTransformer();
        $ingredients = null;
        $category = $this->request->getGet('category');
        if ($ingredientId !== null) {
            $ingredients = $this->model->where('brand_id', $brandId)->find($ingredientId);
            if ($ingredients === null) {
                return $this->failNotFound('Ingredient not found');
            }
            return $this->respond($transformer->toArray($ingredients), 200);
        } else if ($category !== null) {
            $ingredients = $this->model->where('brand_id', $brandId)->where('category', $category)->findAll();
        } else {
            $ingredients = $this->model->where('brand_id', $brandId)->findAll();
        }

        $data = [];
        foreach ($ingredients as $ingredient) { 
            $data[] = $transformer->toArray($ingredient);
        }

        return $this->respond($data, 200);
        
    }
   
    public function postIndex(int $brandId): ResponseInterface
    {
        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');

        $data = $this->request->getJSON(true);
        $data['brand_id'] = $brandId;

        if (!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        $ingredient = $this->model->find($this->model->getInsertID());
        $transformer = new IngredientTransformer();
        return $this->respondCreated($transformer->toArray($ingredient));
    }

    public function putIndex(int $brandId, int $ingredientId): ResponseInterface
    {

        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');

        $ingredient = $this->model->where('brand_id', $brandId)->find($ingredientId);
        if ($ingredient === null) {
            return $this->failNotFound('Ingredient not found');
        }
        $data = $this->request->getJSON(true);
        if (!$this->model->update($ingredientId, $data)){
            return $this->failValidationErrors($this->model->errors());
        }

        $transformer = new IngredientTransformer();
        return $this->respond($transformer->toArray($this->model->find($ingredientId)), 200);

    }

    public function deleteIndex(int $brandId, int $ingredientId): ResponseInterface
    {
        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');
    
        $ingredient = $this->model->where('brand_id', $brandId)->find($ingredientId);
        if ($ingredient === null){
            return $this->failNotFound('Ingredient not found');
        }

        $this->model->delete($ingredientId);
        return $this->respondDeleted(['message' => 'Ingredient deleted successfully']);

    }

    public function getCategories(int $brandId) : ResponseInterface
    {
        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');

        $categories = $this->model->getCategories($brandId);
        return $this->respond($categories, 200);
    }

    public function getMenuItemIngredients(int $brandId, int $menuItemId): ResponseInterface
    {
        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');
        $menuItem = model(MenuItemModel::class)->find($menuItemId);
        if ($menuItem === null || $menuItem['brand_id'] != $brandId) {
            return $this->failNotFound('Menu Item not found');
        }

        $ingredients = $this->model->getMenuItemIngredients($brandId, $menuItemId);
        $transformer = new BomTransformer();
        $data = array_map(fn($ingredient) => $transformer->toArray($ingredient), $ingredients);

        return $this->respond($data, 200);
    }

    public function postMenuItemIngredients(int $brandId, int $menuItemId): ResponseInterface
    {
        model(BrandModel::class)->find($brandId) ?? $this->failNotFound('Brand not found');
        model(MenuItemModel::class)->find($menuItemId) ?? $this->failNotFound('Menu Item not found');

        $data = $this->request->getJSON(true);
        if (!is_array($data)) {
            return $this->failValidationErrors(['Invalid input format. Expected an array of bom ingredients.']);
        }

        try {
            $this->model->saveMenuItemIngredients($brandId, $menuItemId, $data);
            return $this->respond(['message' => 'BOM ingredients saved successfully'], 200);
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred while saving BOM ingredients: ' . $e->getMessage());
        }
    }
}
