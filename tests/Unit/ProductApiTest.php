<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    protected $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductService();
    }

    /** @test */
    public function it_can_create_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99,
        ];

        $product = $this->productService->createProduct($data);

        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    /** @test */
    public function it_can_get_all_products()
    {
        Product::factory()->count(5)->create();

        $products = $this->productService->getAllProducts();

        $this->assertCount(5, $products);
    }

    /** @test */
    public function it_can_get_product_by_id()
    {
        $product = Product::factory()->create();

        $foundProduct = $this->productService->getProductById($product->id);

        $this->assertEquals($product->name, $foundProduct->name);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $data = ['name' => 'Updated Product'];

        $updatedProduct = $this->productService->updateProduct($product->id, $data);

        $this->assertEquals('Updated Product', $updatedProduct->name);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $this->productService->deleteProduct($product->id);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
