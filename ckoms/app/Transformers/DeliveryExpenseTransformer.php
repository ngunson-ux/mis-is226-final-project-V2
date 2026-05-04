<?php

namespace App\Transformers;

use CodeIgniter\API\BaseTransformer;

class DeliveryExpenseTransformer extends BaseTransformer
{
    public function toArray(mixed $resource): array
    {
        return [
            'expense_id'          => $resource['expense_id'] ?? null,
            'delivery_partner_id' => $resource['delivery_partner_id'] ?? null,
            'sales_invoice_id'            => $resource['sales_invoice_id'] ?? null,
            'delivery_fee'        => $resource['delivery_fee'] ?? null,
            'expense_date'        => $resource['expense_date'] ?? null,
            'created_by'          => $resource['created_by'] ?? null,
            'updated_by'          => $resource['updated_by'] ?? null,
            'date_created'        => $resource['date_created'] ?? null,
            'date_updated'        => $resource['date_updated'] ?? null,
        ];
    }
}
