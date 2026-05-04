<?php

namespace App\Transformers;

use CodeIgniter\API\BaseTransformer;

class IngredientTransformer extends BaseTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param mixed $resource
     *
     * @return array<string, mixed>
     */
    public function toArray(mixed $resource): array
    {
        return [
            'ingredient_id' => $resource['ingredient_id'] ?? null,
            'brand_id' => $resource['brand_id'] ?? null,
            'name' => $resource['name'] ?? null,
            'brand' => $resource['brand'] ?? null,
            'description' => $resource['description'] ?? null,
            'qty_purchased' => $resource['qty_purchased'] ?? null,
            'qty_remaining' => $resource['qty_remaining'] ?? null,
            'unit_of_measure' => $resource['unit_of_measure'] ?? null,
            'category' => $resource['category'] ?? null,
            'allergen_flag' => $resource['allergen_flag'] ?? null,
            'created_by' => $resource['created_by'] ?? null,
            'updated_by' => $resource['updated_by'] ?? null,
            'date_created' => $resource['date_created'] ?? null,
            'date_updated' => $resource['date_updated'] ?? null,
        ];
    }
}
