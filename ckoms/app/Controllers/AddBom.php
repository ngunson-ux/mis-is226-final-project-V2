<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

use App\Models\IngredientModel;
use App\Transformers\IngredientTransformer;

class AddBom extends BaseController
{
    const PAGE_TITLE = 'Add Menu Item Ingredients';

    public function getIndex(?int $menuItemId = null)
    {
        // $transformer = new IngredientTransformer();
        // TODO: Required to pass the brandID and categoryID
        $brandId = $this->request->getGet('brandId') ?? $this->request->getCookie('brandId');
        $brandName = $this->request->getGet('brandName') ?? $this->request->getCookie('brandName');

        if ($brandId === null || $brandName === null) {
            return redirect()->to("/")->with('error', 'Brand information is missing. Please select a brand first.');
        }

        $data = [];

        if ($menuItemId === null) {
            return view('add-bom', [
                'brandId' => $brandId,
                'brandName' => $brandName,
                'menuItemId' => $menuItemId,
                'result' => $data,
                'pageTitle' => self::PAGE_TITLE
            ]);
        }

        $category = $this->request->getGet('category');
        if ($category === '') {
            $category = null;
        }
        $model = model(IngredientModel::class);

        if ($model !== null) {
            $data = [
                'brandIngredients' => $model->getIngredients($brandId, $category),
                'menuItemIngredients' => $model->getMenuItemIngredients($brandId, $menuItemId),
            ];
        }

        log_message('debug', 'Data retrieved for AddBom: ' . print_r($data, true));

        return view('add-bom', [
            'brandId' => $brandId,
            'brandName' => $brandName,
            'menuItemId' => $menuItemId,
            'data' => $data,
            'pageTitle' => self::PAGE_TITLE
        ]);
    }
}
