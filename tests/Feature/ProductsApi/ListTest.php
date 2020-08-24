<?php

namespace Tests\Feature\ProductsApi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ListTest extends TestCase
{
    /**
     * API endpoint
     *
     * @var string
     */
    protected $endpoint = '/api/products';

    /**
     * List JSON structure response
     *
     * @var array
     */
    protected $listStructure = [
        'current_page',
        'data' => [
            '*' => ['id', 'name', 'category', 'supplier', 'description', 'price', 'quantity', 'created_at', 'updated_at']
        ],
        'first_page_url',
        'from',
        'last_page',
        'last_page_url'
    ];

    /**
     * Empty list products test
     *
     * @return void
     */
    public function testEmptyList()
    {
        if (Product::all()->count() >= 1) {
            Product::truncate();
        }

        $this->listResponse();
    }

    /**
     * List products test
     *
     * @return void
     */
    public function testList()
    {
        if (Product::all()->count() < 1) {
            factory(Product::class, 10)->create();
        }

        $this->listResponse();
    }

    /**
     * List products with page request test
     *
     * @return void
     */
    public function testListPageRequest()
    {
        if (Product::all()->count() <= 10) {
            factory(Product::class, 20)->create();
        }

        $this->listResponse(2);
    }

    /**
     * Get list response assertion
     *
     * @param integer $page
     * @return void
     */
    private function listResponse($page = null) {
        if (!$page) {
            $response = $this->getJson($this->endpoint);
        } else {
            $response = $this->getJson($this->endpoint . '?page=' . $page);
        }

        $response->assertStatus(200)->assertJsonStructure($this->listStructure);
    }
}
