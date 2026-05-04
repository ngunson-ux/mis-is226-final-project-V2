<?php

namespace App\Transformers;

use CodeIgniter\API\BaseTransformer;

class RiderPaymentTransformer extends BaseTransformer
{
    public function toArray(mixed $resource): array
    {
        return [
            'payment_id'          => $resource['payment_id'] ?? null,
            'delivery_partner_id' => $resource['delivery_partner_id'] ?? null,
            'payment_amount'      => $resource['payment_amount'] ?? null,
            'payment_method'      => $resource['payment_method'] ?? null,
            'payment_status'      => $resource['payment_status'] ?? null,
            'created_by'          => $resource['created_by'] ?? null,
            'updated_by'          => $resource['updated_by'] ?? null,
            'date_created'        => $resource['date_created'] ?? null,
            'date_updated'        => $resource['date_updated'] ?? null,
        ];
    }
}
