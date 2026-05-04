<?php

namespace App\Controllers;

use App\Models\RiderPaymentModel;
use App\Models\DeliveryPartnerModel;

class ManageRiderPayment extends BaseController
{
    const PAGE_TITLE = 'Manage Rider Payment';

    public function getIndex(): string
    {
        $model = new RiderPaymentModel();
        $page = $this->request->getGet('page');

        $model->select('rider_payment.*, 
            CONCAT(dp.first_name, " ", dp.last_name) as partner_name', false)
            ->join('delivery_partners dp', 'dp.delivery_partner_id = rider_payment.delivery_partner_id', 'left');


        $data = [
            'data'  => $model->paginate(8, 'default', $page),
            'pager' => $model->pager,
        ];
        return view('manage-rider-payment', [
            'result'    => $data,
            'pageTitle' => self::PAGE_TITLE,
            'brandId'   => '',
            'brandName' => 'Cloud Kitchen',
            'deliveryPartners' => (new DeliveryPartnerModel())->findAll(),
        ]);
    }
}
