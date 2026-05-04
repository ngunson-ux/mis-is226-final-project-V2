<?php

namespace App\Controllers;

class InventoryDaysReport extends BaseController
{
    public function getIndex()
    {
        $db = \Config\Database::connect();

        $period = $this->request->getGet('period') ?? 'month';
        $stockoutFilter = $this->request->getGet('stockout_filter') ?? '';

        $dateFormat = match ($period) {
            'day' => '%Y-%m-%d',
            'year' => '%Y',
            default => '%Y-%m',
        };

        $query = $db->query("
            SELECT
                DATE_FORMAT(ir.transaction_date, '{$dateFormat}') AS report_period,
                i.ingredient_id,
                i.name,
                i.qty_remaining,
                i.unit_of_measure,
                COALESCE(SUM(CASE WHEN ir.transaction_type = 'RESTOCK' THEN ir.quantity ELSE 0 END), 0) AS total_restock,
                COALESCE(SUM(CASE WHEN ir.transaction_type = 'USAGE' THEN ir.quantity ELSE 0 END), 0) AS total_usage,
                COUNT(DISTINCT ir.transaction_date) AS active_days,
                CASE
                    WHEN COALESCE(SUM(CASE WHEN ir.transaction_type = 'USAGE' THEN ir.quantity ELSE 0 END), 0) = 0
                    THEN NULL
                    ELSE ROUND(
                        i.qty_remaining /
                        (SUM(CASE WHEN ir.transaction_type = 'USAGE' THEN ir.quantity ELSE 0 END) / COUNT(DISTINCT ir.transaction_date)),
                    2)
                END AS estimated_days_before_stockout
            FROM ingredient i
            LEFT JOIN inventory_restocking_fact ir
                ON i.ingredient_id = ir.ingredient_id
            GROUP BY
                DATE_FORMAT(ir.transaction_date, '{$dateFormat}'),
                i.ingredient_id,
                i.name,
                i.qty_remaining,
                i.unit_of_measure
            ORDER BY i.name ASC
        ");

        $records = $query->getResultArray();

        if ($stockoutFilter !== '') {
            $records = array_filter($records, function ($record) use ($stockoutFilter) {
                $days = $record['estimated_days_before_stockout'];

                if ($stockoutFilter === 'critical') {
                    return $days !== null && $days <= 3;
                }

                if ($stockoutFilter === 'warning') {
                    return $days !== null && $days > 3 && $days <= 7;
                }

                if ($stockoutFilter === 'healthy') {
                    return $days !== null && $days > 7;
                }

                if ($stockoutFilter === 'no_usage') {
                    return $days === null;
                }

                return true;
            });
        }

        return view('inventory-days-report', [
            'records' => $records,
            'period' => $period,
            'stockoutFilter' => $stockoutFilter,
            'brandId' => '',
            'brandName' => 'CloudRave',
            'pageTitle' => 'Inventory Days Level Report',
        ]);
    }
}