<?php
declare(strict_types=1);

namespace Foo\Product;

use PHPUnit\Framework\TestCase;

final class ProductIdTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_generate_a_uuid(): void
    {
        $productId = ProductId::generate();
        self::assertInstanceOf(ProductId::class, $productId);
    }

    /**
     * @test
     */
    public function it_can_create_a_uuid_from_string(): void
    {
        $productId = ProductId::fromString('dd53adb1-2605-44e7-8258-c00eeb2a73e4');
        self::assertInstanceOf(ProductId::class, $productId);
        self::assertSame('dd53adb1-2605-44e7-8258-c00eeb2a73e4', $productId->__toString());
    }
}
