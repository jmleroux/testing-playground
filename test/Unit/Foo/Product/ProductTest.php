<?php
declare(strict_types=1);

namespace Foo\Product;

use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function it_is_instanciable(): void
    {
        $productId = ProductId::generate();
        self::assertInstanceOf(Product::class, new Product($productId, 'foo_product'));
    }
}
