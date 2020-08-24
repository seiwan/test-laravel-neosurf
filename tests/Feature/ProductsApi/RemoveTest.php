<?php

namespace Tests\Feature\ProductsApi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class RemoveTest extends TestCase
{
    /**
     * API endpoint
     *
     * @var string
     */
    protected $endpoint = '/api/products/remove/1';

    /**
     * Remove a unexisting product test
     *
     * @return void
     */
    public function testRemoveUnexisting()
    {
        if (Product::all()->count() >= 1) {
            Product::truncate();
        }

        $this->assertRemoveProduct(404);
    }

    /**
     * Remove a product test
     *
     * @return void
     */
    public function testRemove()
    {
        if (Product::all()->count() < 1) {
            factory(Product::class)->create();
        }

        $this->assertRemoveProduct(200);
    }

    /**
     * Delet product request assertion
     *
     * @return void
     */
    private function assertRemoveProduct($status) {
        $response = $this->deleteJson($this->endpoint);

        $response->assertStatus($status);
    }
}
