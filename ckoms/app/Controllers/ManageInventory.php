<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\BrandModel;
use App\Models\IngredientModel;

class ManageInventory extends BaseController
{
    const PAGE_TITLE = 'Manage Inventory';

    public function getIndex(): string
    {
        // $transformer = new IngredientTransformer();
        // TODO: Required to pass the brandID and categoryID
        $brandId = $this->request->getCookie('brandId');
        $brandName = $this->request->getCookie('brandName');
        
        $data = [];
        $page = $this->request->getGet('page');
        $category = $this->request->getGet('category');


        $brand = model(BrandModel::class)->find($brandId);
        if ($brand === null) {
            throw new PageNotFoundException('Brand not found');
        }

        $model = model(IngredientModel::class);
        if ($model !== null) {
            $data = [
                'data' => $model->where('brand_id', $brandId)->paginate(8, 'default', $page),
                'pager' => $model->pager
                ];
        } else {
            throw new PageNotFoundException('Ingredient model not found');
        }
        return view('manage-inventory', [
            'brandId' => $brandId,
            'brandName' => $brandName,
            'result' => $data,
            'pageTitle' => self::PAGE_TITLE
        ]);
    }

}