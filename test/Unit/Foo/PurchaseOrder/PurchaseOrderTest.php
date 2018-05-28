<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Foo\Product\ProductId;
use Foo\Supplier;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class PurchaseOrderTest extends TestCase
{
    /**
     * @test
     */
    public function it_is_instantiable(): void
    {
        $productId = ProductId::generate();
        $lines = [new PurchaseOrderLine($productId, new QuantityOrdered(1), new QuantityReceived(0))];
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');
        self::assertInstanceOf(PurchaseOrder::class, new PurchaseOrder($purchaseOrderId, $lines, $supplier));
    }

    public function it_can_get_a_line_by_number()
    {
        $productId = ProductId::generate();
        $lines = [new PurchaseOrderLine($productId, new QuantityOrdered(1), new QuantityReceived(0))];
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');

        $purchaseOrder = new PurchaseOrder($purchaseOrderId, $lines, $supplier);
        Assert::assertInstanceOf(PurchaseOrderLine::class, $purchaseOrder->getLineByNumber(2));
    }
}
