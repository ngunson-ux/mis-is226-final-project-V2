<?php

namespace App\Controllers\Api;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use App\Models\IngredientModel;


class IngredientsTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

    }

    public function testShowIngredients()
    {
        $mockModel = $this->createMock(IngredientModel::class);
        $mockModel
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([
                [
                    'ingredient_id' => 1,
                    'name' => 'Flour',
                    'brand' => 'Generic',
                    'description' => 'All-purpose flour',
                    'qty_purchased' => 1000,
                    'qty_remaining' => 500,
                    'unit_of_measure' => 'g',
                    'category' => 'Baking',
                    'allergen_flag' => false,
                    'created_by' => 'admin',
                    'updated_by' => 'admin',
                    'date_created' => '2024-01-01 00:00:00',
                    'date_updated' => '2024-01-01 00:00:00',
                ],
            ]);

        \CodeIgniter\Config\Factories::injectMock('models', IngredientModel::class, $mockModel);

        $response = $this->withUri('http://www.example.com/api/ingredients')
            ->controller(Ingredients::class)
            ->execute('getIndex');

        $response->assertOK();
        $response->assertJSONFragment([['name' => 'Flour']]);

    }
}