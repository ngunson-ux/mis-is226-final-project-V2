<?php
namespace App\Resources;

use App\Models\IngredientModel;

class Ingredients implements IngredientsIF
{

    private $model;

    public function __construct(?IngredientModel $model = null)
    {
        $this->model = $model ?? model(IngredientModel::class);
    }

    // This method will be called when the /ingredients route is accessed with a GET request.
    public function get(?int $id = null, ?array $requestContext = null)
    {
        $ingredients = null;
        $category = $requestContext['category'] ?? null;
        if ($id !== null) {
            $ingredients = $this->model->where('industry_id', $id);
        } else if ($category !== null) {
            $ingredients = $this->model->where('category', $category);
        } else {
            $ingredients = $this->model;
        }
        return $ingredients;  
    }

    public function getCategories()
    {
        return $this->model->getCategories();
    }
}

?>