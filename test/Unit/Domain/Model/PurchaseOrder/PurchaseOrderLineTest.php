<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Domain\Model\Product\ProductId;
use PHPUnit\Framework\TestCase;

final class PurchaseOrderLineTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_get_line_number(): void
    {
        $line = new PurchaseOrderLine(
            $productId = ProductId::generate(),
            new QuantityOrdered(1),
            new QuantityReceived(0),
            1
        );
        self::assertSame(1, $line->getLineNumber());
    }
}
