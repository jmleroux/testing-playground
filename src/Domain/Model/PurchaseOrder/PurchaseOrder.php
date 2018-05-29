<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Assert\Assert;
use Common\Aggregate;
use Common\AggregateId;
use Domain\Model\Product\ProductId;
use Domain\Model\PurchaseOrder\Event\PurchaseOrderCreated;
use Domain\Model\PurchaseOrder\Event\PurchaseOrderLineAdded;
use Domain\Model\Supplier;

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


    public function processReceipt(ProductId $productId, QuantityReceived $quantityReceived): void
    {
        /** @var PurchaseOrderLine $line */
        foreach ($this->lines as $line) {
            if ((string)$line->getProductId() === (string)$productId) {
                $line->addQuantityReceived($quantityReceived);
            }
        }
    }

    public function id(): AggregateId
    {
        return $this->id;
    }
}
