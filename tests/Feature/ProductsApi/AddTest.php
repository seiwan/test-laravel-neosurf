<?php

namespace Tests\Feature\ProductsApi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Str;

class AddTest extends TestCase
{
     use WithFaker;

    /**
     * API endpoint
     *
     * @var string
     */
    protected $endpoint = '/api/products/add';

    /**
     * Add a product with errors test
     *
     * @return void
     */

    public function testAddErrors()
    {
        // Name errors
        $this->shouldBeRequired('name');
        $this->shouldBeString('name');
        $this->shouldHaveMaxChars('name', 255);

        // Category errors
        $this->shouldBeRequired('category');
        $this->shouldBeString('category');
        $this->shouldHaveMaxChars('category', 255);

        // Supplier errors
        $this->shouldBeRequired('supplier');
        $this->shouldBeString('supplier');
        $this->shouldHaveMaxChars('supplier', 255);

        // Description errors
        $this->shouldBeString('description');

        // Price errors
        $this->shouldBeRequired('price');
        $this->shouldBeNumeric('price');

        // Quantity errors
        $this->shouldBeInteger('quantity');
    }

    /**
     * Add a product with success test
     *
     * @return void
     */
    public function testAddSuccessful()
    {
        $response = $this->postJson(
            $this->endpoint,
            [
                'name' => $this->faker->word,
                'category' => $this->faker->word,
                'supplier' => $this->faker->company,
                'description' => $this->faker->text(200),
                'price' => $this->faker->randomFloat(2, 0, 100000),
                'quantity' => $this->faker->numberBetween(0, 100000)
            ]
        );

        $response->assertStatus(201)->assertJsonStructure(['id', 'name', 'category', 'supplier', 'description', 'price', 'quantity', 'created_at', 'updated_at']);
    }

    /**
     * Data should be required assertion
     *
     * @param string $data
     * @return void
     */
    private function shouldBeRequired($data) {
        $response = $this->postJson($this->endpoint, [$data => null]);

        $response->assertJsonValidationErrors($data);
    }

    /**
     * Data should be a string assertion
     *
     * @param string $data
     * @return void
     */
    private function shouldBeString($data) {
        $response = $this->postJson($this->endpoint, [$data => $this->faker->randomNumber()]);

        $response->assertJsonValidationErrors($data);
    }

    /**
     * Data should have characters max assertion
     *
     * @param string $data
     * @param integer $max
     * @return void
     */
    private function shouldHaveMaxChars($data, $max) {
        $response = $this->postJson($this->endpoint, [$data => Str::random(++$max)]);

        $response->assertJsonValidationErrors($data);
    }

    /**
     * Data should be numeric assertion
     *
     * @param string $data
     * @return void
     */
    private function shouldBeNumeric($data) {
        $response = $this->postJson($this->endpoint, [$data => $this->faker->word()]);

        $response->assertJsonValidationErrors($data);
    }

    /**
     * Data should be integer assertion
     *
     * @param string $data
     * @return void
     */
    private function shouldBeInteger($data) {
        $response = $this->postJson($this->endpoint, [$data => $this->faker->word()]);

        $response->assertJsonValidationErrors($data);

        $response = $this->postJson($this->endpoint, [$data => $this->faker->randomFloat()]);

        $response->assertJsonValidationErrors($data);
    }
}
