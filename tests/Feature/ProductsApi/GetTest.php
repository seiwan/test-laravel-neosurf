<?php

namespace Tests\Feature\ProductsApi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class GetTest extends TestCase
{
    /**
     * API endpoint
     *
     * @var string
     */
    protected $endpoint = '/api/products/1';

    /**
     * Get a unexisting product test
     *
     * @return void
     */
    public function testGetUnexisting()
    {
        if (Product::all()->count() >= 1) {
            Product::truncate();
        }

        $response = $this->getJson($this->endpoint);

        $response->assertStatus(404);
    }

    /**
     * Get a product test
     *
     * @return void
     */
    public function testGet()
    {
        if (Product::all()->count() < 1) {
            factory(Product::class)->create();
        }

        $response = $this->getJson($this->endpoint);

        $response->assertStatus(200)->assertJsonStructure(['id', 'name', 'category', 'supplier', 'description', 'price', 'quantity', 'created_at', 'updated_at']);
    }
}
