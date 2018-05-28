<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

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
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');
        self::assertInstanceOf(PurchaseOrder::class, new PurchaseOrder($purchaseOrderId, $supplier));
    }

    public function it_can_get_a_line_by_number()
    {
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');

        $purchaseOrder = new PurchaseOrder($purchaseOrderId, $supplier);
        Assert::assertInstanceOf(PurchaseOrder::class, $purchaseOrder->getLineByNumber(2));
    }
}
