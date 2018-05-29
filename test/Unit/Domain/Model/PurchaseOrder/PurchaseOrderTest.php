<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Domain\Model\Product\ProductId;
use Domain\Model\Supplier\Supplier;
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

    /**
     * @test
     */
    public function it_can_get_a_line_by_number()
    {
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');

        $purchaseOrder = new PurchaseOrder($purchaseOrderId, $supplier);

        $purchaseOrder->addLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1)
        );
        $purchaseOrder->addLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1)
        );

        Assert::assertInstanceOf(PurchaseOrderLine::class, $purchaseOrder->getLineByNumber(2));
    }

    /**
     * @test
     * @expectedException \Assert\InvalidArgumentException
     */
    public function it_cannot_get_an_unknown_line()
    {
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');

        $purchaseOrder = new PurchaseOrder($purchaseOrderId, $supplier);

        $purchaseOrder->addLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1)
        );
        $purchaseOrder->addLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1)
        );
        $purchaseOrder->getLineByNumber(3);
    }

    /**
     * @test
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionMessage  Already placed
     */
    public function it_cannot_be_placed_more_than_once()
    {
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');

        $purchaseOrder = new PurchaseOrder($purchaseOrderId, $supplier);

        $purchaseOrder->addLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1)
        );
        $purchaseOrder->addLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1)
        );
        $purchaseOrder->place();
        $purchaseOrder->place();
    }

    /**
     * @test
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionMessage  Yarien laddans
     */
    public function it_cannot_placed_an_empty_order()
    {
        $purchaseOrderId = PurchaseOrderId::generate();
        $supplier = new Supplier('uuid', 'foo_supplier');

        $purchaseOrder = new PurchaseOrder($purchaseOrderId, $supplier);
        $purchaseOrder->place();
    }
}
