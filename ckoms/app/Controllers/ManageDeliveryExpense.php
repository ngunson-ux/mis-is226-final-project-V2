<?php

namespace App\Controllers;

use App\Models\DeliveryExpenseModel;
use App\Models\DeliveryPartnerModel;
use App\Models\SalesInvoiceModel;

class ManageDeliveryExpense extends BaseController
{
    const PAGE_TITLE = 'Manage Delivery Expense';

    public function getIndex(): string
    {
        $model = new DeliveryExpenseModel();
        $page = $this->request->getGet('page');

        $model->select('delivery_expense.*, 
            CONCAT(dp.first_name, " ", dp.last_name) as partner_name,
            CONCAT("Invoice #", si.sales_invoice_id, " - P", FORMAT(si.total_amount, 2), " (", si.delivery_address, ")") as invoice_display', false)
            ->join('delivery_partners dp', 'dp.delivery_partner_id = delivery_expense.delivery_partner_id', 'left')
            ->join('sales_invoice si', 'si.sales_invoice_id = delivery_expense.sales_invoice_id', 'left');

        $data = [
            'data'  => $model->paginate(8, 'default', $page),
            'pager' => $model->pager,
        ];

        $completedInvoices = (new SalesInvoiceModel())
            ->select('sales_invoice.*')
            ->where('order_status', 'Completed')
            ->whereNotIn('sales_invoice_id', function ($builder) {
                return $builder->select('sales_invoice_id')->from('delivery_expense');
            })
            ->findAll();

        return view('manage-delivery-expense', [
            'result'    => $data,
            'pageTitle' => self::PAGE_TITLE,
            'brandId'   => '',
            'brandName' => 'Cloud Kitchen',
            'deliveryPartners' => (new DeliveryPartnerModel())->findAll(),
            'salesInvoices'    => (new SalesInvoiceModel())->where('order_status', 'Completed')->findAll(),
            'completedInvoices'  => $completedInvoices,
        ]);
    }
}
