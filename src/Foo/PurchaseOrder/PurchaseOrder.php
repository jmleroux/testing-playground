<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Assert\Assert;
use Common\Aggregate;
use Common\AggregateId;
use Foo\Product\ProductId;
use Foo\PurchaseOrder\Event\PurchaseOrderCreated;
use Foo\PurchaseOrder\Event\PurchaseOrderLineAdded;
use Foo\Supplier;

final class PurchaseOrder extends Aggregate
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

        $this->recordThat(
            new PurchaseOrderCreated($this->id, new \DateTimeImmutable())
        );
    }

    public function addLine(ProductId $productId, QuantityOrdered $quantityOrdered): void
    {
        $quantityReceived = new QuantityReceived(0);
        $lineNumber = count($this->lines) + 1;
        $line = new PurchaseOrderLine($productId, $quantityOrdered, $quantityReceived, $lineNumber);
        Assert::that($this->lines)->keyNotExists($line->getLineNumber());
        $this->lines[$line->getLineNumber()] = $line;

        $this->recordThat(
            new PurchaseOrderLineAdded($this->id, $line, new \DateTimeImmutable())
        );
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

    public function id(): AggregateId
    {
        return $this->id;
    }
}
