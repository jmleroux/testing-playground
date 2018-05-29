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
    private $lines = [];
    /** @var Supplier */
    private $supplier;
    /** @var bool */
    private $isPlaced = false;

    public function __construct(PurchaseOrderId $id, Supplier $supplier)
    {
        $this->id = $id;
        $this->supplier = $supplier;
    }

    public function addLine(ProductId $productId, QuantityOrdered $quantityOrdered): void
    {
        $quantityReceived = new QuantityReceived(0);
        $lineNumber = count($this->lines) + 1;
        $line = new PurchaseOrderLine($productId, $quantityOrdered, $quantityReceived, $lineNumber);
        Assert::that($this->lines)->keyNotExists($line->getLineNumber());
        $this->lines[$line->getLineNumber()] = $line;
    }

    public function getLineByNumber(int $lineNumber): PurchaseOrderLine
    {
        Assert::that($this->lines)->keyExists($lineNumber);

        return $this->lines[$lineNumber];
    }

    public function place(): void
    {
        Assert::that($this->isPlaced)->false('Already placed');
        Assert::that($this->lines)->notEmpty('Yarien laddans');
        $this->isPlaced = true;
    }
}
