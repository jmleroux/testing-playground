<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Assert\Assert;
use Foo\Product\ProductId;
use Foo\Supplier;

final class PurchaseOrder
{
    /** @var PurchaseOrderId */
    private $id;
    /** @var PurchaseOrderLine[] */
    private $lines;
    /** @var Supplier */
    private $supplier;

    public function __construct(PurchaseOrderId $id, Supplier $supplier)
    {
        $this->id = $id;
        $this->supplier = $supplier;
    }

    public function addLine(ProductId $productId, QuantityOrdered $quantityOrdered): void
    {
        $quantityReceived = new QuantityReceived(0);
        $lineNumber = max(array_keys($this->lines)) + 1;
        $line = new PurchaseOrderLine($productId, $quantityOrdered, $quantityReceived, $lineNumber);
        Assert::that($this->lines)->keyNotExists($line->getLineNumber());
        $this->lines[$line->getLineNumber()] = $line;
    }

    public function getLineByNumber(int $lineNumber): PurchaseOrderLine
    {
        return $this->lines[$lineNumber];
    }
}
