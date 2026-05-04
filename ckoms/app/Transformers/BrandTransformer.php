<?php

namespace App\Transformers;

use CodeIgniter\API\BaseTransformer;

class BrandTransformer extends BaseTransformer
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
            'brand_id' => $resource['brand_id'] ?? null,
            'brand_name' => $resource['brand_name'] ?? null,
            'brand_description' => $resource['brand_description'] ?? null,
            'brand_logo_url' => $resource['brand_logo_url'] ?? null,
            'contact_email' => $resource['contact_email'] ?? null,
            'contact_phone' => $resource['contact_phone'] ?? null,
            'business_address' => $resource['business_address'] ?? null,
            'business_license_number' => $resource['business_license_number'] ?? null,
            'brand_status' => $resource['brand_status'] ?? null,
            'created_by' => $resource['created_by'] ?? null,
            'updated_by' => $resource['updated_by'] ?? null,
            'date_created' => $resource['date_created'] ?? null,
            'date_updated' => $resource['date_updated'] ?? null,
        ];
    }
}
