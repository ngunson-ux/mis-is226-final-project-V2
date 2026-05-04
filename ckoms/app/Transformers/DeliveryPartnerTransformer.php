<?php

namespace App\Transformers;

use CodeIgniter\API\BaseTransformer;

class DeliveryPartnerTransformer extends BaseTransformer
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
            'delivery_partner_id' => $resource['delivery_partner_id'] ?? null,
            'name' => $resource['name'] ?? null,
            'contact_number' => $resource['contact_number'] ?? null,
            'email' => $resource['email'] ?? null,
            'availability_status' => $resource['availability_status'] ?? null,
            'assigned_area' => $resource['assigned_area'] ?? null,
            'vehicle_type' => $resource['vehicle_type'] ?? null,
            'created_by' => $resource['created_by'] ?? null,
            'updated_by' => $resource['updated_by'] ?? null,
            'date_created' => $resource['date_created'] ?? null,
            'date_updated' => $resource['date_updated'] ?? null,
        ];
    }
}