<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\BomModel;

class IngredientModel extends Model
{
    protected $table            = 'ingredient';
    protected $primaryKey       = 'ingredient_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['brand_id', 'name', 'brand', 'description', 'qty_purchased', 'qty_remaining', 'unit_of_measure', 'category', 'allergen_flag', 'created_by', 'updated_by'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'date_created';
    protected $updatedField  = 'date_updated';
    protected $deletedField  = null;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getCategories(int $brandId)
    {
        $sql = "SELECT DISTINCT category FROM ingredient WHERE brand_id = ?";
        return array_map(fn($result) => $result['category'], $this->db->query($sql, [$brandId])->getResultArray());
    }

    public function getIngredients(int $brandId, ?string $category = null)
    {
        $builder = $this->where('brand_id', $brandId);
        if ($category !== null) {
            $builder = $builder->where('category', $category);
        }
        return $builder->findAll();
    }

    public function getMenuItemIngredients(int $brandId, int $menuItemId)
    {
        $sql = "SELECT
                    i.ingredient_id,
                    i.brand_id, 
                    i.name,
                    i.brand,
                    i.description,
                    b.qty_required,
                    i.unit_of_measure,
                    i.category,
                    i.allergen_flag,
                    m.item_name,
                    b.date_created,
                    b.date_updated
                FROM ingredient i
                JOIN bom_bridge b ON i.ingredient_id = b.ingredient_id
                JOIN menu_item m ON b.menu_item_id = m.menu_item_id
                WHERE i.brand_id = ? AND b.menu_item_id = ?";
        return $this->db->query($sql, [$brandId, $menuItemId])->getResultArray();
    }

    public function saveMenuItemIngredients(int $brandId, int $menuItemId, array $bomIngredients)
    {
        try {
            $this->db->transStart();
            $this->db->table('bom_bridge')->where('menu_item_id', $menuItemId)->delete();
            log_message('debug', "Deleted existing BOM entries for menu_item_id: $menuItemId");
            log_message('debug', "Processing BOM ingredients for menu_item_id: $menuItemId with data: " . json_encode($bomIngredients));
            foreach ($bomIngredients as $bomIngredient) {
                log_message('debug', "Processing ingredient for menu_item_id: $menuItemId with data: " . json_encode($bomIngredient));
                $ingredientId = $bomIngredient['ingredient_id'] ?? null;
                if ($ingredientId === null) {
                    $ingredient = [
                        'brand_id' => $brandId,
                        'name' => $bomIngredient['name'] ?? null,
                        'brand' => $bomIngredient['brand'] ?? null,
                        'description' => $bomIngredient['description'] ?? null,
                        'qty_purchased' => 0,
                        'qty_remaining' => 0,
                        'unit_of_measure' => $bomIngredient['unit_of_measure'] ?? null,
                        'category' => $bomIngredient['category'] ?? null,
                        'allergen_flag' => $bomIngredient['allergen_flag'] ?? null
                    ];
                    log_message('debug', "Inserting new ingredient for menu_item_id: $menuItemId with data: " . json_encode($ingredient));
                    if (!($ingredientId = $this->insert($ingredient))) {
                        $errors = $this->errors();
                        throw new \Exception("Failed to insert ingredient: " . json_encode($errors));
                    } else {
                        $ingredientId = $this->getInsertID();
                    }
                    log_message('debug', "Created new ingredient with ID: $ingredientId for menu_item_id: $menuItemId");
                }
                $bomModel = model(BomModel::class);
                $data = [
                    'ingredient_id' => $ingredientId,
                    'menu_item_id' => $menuItemId,
                    'qty_required' => $bomIngredient['quantity_required'],
                    'unit_of_measure' => $bomIngredient['unit_of_measure']
                ];
                log_message('debug', "Inserting BOM entry for menu_item_id: $menuItemId with data: " . json_encode($data));
                if (!$bomModel->insert($data)) {
                    $errors = $bomModel->errors();
                    throw new \Exception("Failed to insert BOM entry: " . json_encode($errors));
                }
            }
            $this->db->transComplete();
        } catch (\Exception $e) {
            log_message('error', "Error inserting ingredients for menu_item_id: $menuItemId - " . $e->getMessage());
            throw $e; // Re-throw the exception after logging
        }
    }
}
