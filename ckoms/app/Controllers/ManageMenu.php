<?php

namespace App\Controllers;

use App\Models\MenuItemModel;

class ManageMenu extends BaseController
{
    const PAGE_TITLE = 'Manage Menu';

    public function getIndex(): string
    {
        $model = new MenuItemModel();

        $page = $this->request->getGet('page');
        $brandId = $this->request->getGet('brandId');
        $brandName = $this->request->getGet('brandName') ?? 'Cloud Kitchen';

        if (!empty($brandId)) {
            $model->where('brand_id', $brandId);
        }

        $data = [
            'data'  => $model->paginate(10, 'default', $page),
            'pager' => $model->pager,
        ];

        return view('manage-menu', [
            'result'    => $data,
            'pageTitle' => self::PAGE_TITLE . (!empty($brandId) ? " = " . $brandName : ''),
            'brandId'   => $brandId ?? '',
            'brandName' => $brandName,
        ]);
    }

    public function getCreate()
    {
        $brandModel = new \App\Models\BrandModel();

        return view('add-menu', [
            'brandId'   => $this->request->getGet('brandId'),
            'brandName' => $this->request->getGet('brandName'),
            'pageTitle' => 'Add Menu Item',
            'brands'    => $brandModel->findAll(),
        ]);
    }
    public function postStore()
    {
        $model = new \App\Models\MenuItemModel();

        $menuItemId = $model->insert([
            'brand_id' => $this->request->getPost('brand_id'),
            'item_name' => $this->request->getPost('item_name'),
            'menu_category' => $this->request->getPost('menu_category'),
            'price' => $this->request->getPost('price'),
            'availability_status' => $this->request->getPost('availability_status'),
            'date_created' => date('Y-m-d H:i:s'),
            'date_updated' => date('Y-m-d H:i:s'),
        ]);

        // Redirect to BOM 
        return redirect()->to(
            '/add-bom/' . $menuItemId .
            '?brandId=' . $this->request->getPost('brand_id') .
            '&brandName=' . urlencode($this->request->getPost('brandName'))
        );
    }

    public function getBomDetails($menuItemId)
    {
        $db = \Config\Database::connect();

        $menuItem = $db->table('menu_item')
            ->where('menu_item_id', $menuItemId)
            ->get()
            ->getRowArray();

        $brand = $db->table('brand')
            ->where('brand_id', $menuItem['brand_id'])
            ->get()
            ->getRowArray();

        $bomItems = $db->table('bom_bridge')
            ->select('bom_bridge.*, ingredient.name, ingredient.unit_of_measure')
            ->join('ingredient', 'ingredient.ingredient_id = bom_bridge.ingredient_id')
            ->where('bom_bridge.menu_item_id', $menuItemId)
            ->get()
            ->getResultArray();

        return view('view-bom', [
            'menuItem' => $menuItem,
            'bomItems' => $bomItems,
            'brandId' => $menuItem['brand_id'] ?? '',
            'brandName' => $brand['brand_name'] ?? 'Cloud Kitchen',
            'pageTitle' => 'BOM Details',
        ]);
    }
}