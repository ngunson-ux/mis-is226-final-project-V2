<?php

namespace App\Transformers;

use CodeIgniter\API\BaseTransformer;

class BomTransformer extends BaseTransformer
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
            'qty_required' => $resource['qty_required'] ?? null,
            'unit_of_measure' => $resource['unit_of_measure'] ?? null,
            'category' => $resource['category'] ?? null,
            'allergen_flag' => $resource['allergen_flag'] ?? null,
            'date_created' => $resource['date_created'] ?? null,
            'date_updated' => $resource['date_updated'] ?? null,
        ];
    }
}
