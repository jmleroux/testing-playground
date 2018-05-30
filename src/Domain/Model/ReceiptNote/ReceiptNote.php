<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote;

use Common\Aggregate;
use Common\AggregateId;
use Domain\Model\Product\ProductId;
use Domain\Model\PurchaseOrder\PurchaseOrderId;
use Domain\Model\PurchaseOrder\QuantityReceived;
use Domain\Model\ReceiptNote\Event\ReceiptNoteCreated;
use Domain\Model\ReceiptNote\Event\ReceiptNoteLineAdded;

final class ReceiptNote extends Aggregate
{
    /** @var ReceiptNoteId */
    private $id;
    /** @var ReceiptNoteLine[] */
    private $lines = [];
    /** @var AggregateId */
    private $purchaseOrderId;

    public function __construct(ReceiptNoteId $id, AggregateId $purchaseOrderId)
    {
        $this->id = $id;
        $this->purchaseOrderId = $purchaseOrderId;

        $this->recordThat(
            new ReceiptNoteCreated($this->id, new \DateTimeImmutable())
        );
    }

    public function addLine(ProductId $productId, QuantityReceived $quantityReceived): void
    {
        $line = new ReceiptNoteLine($productId, $quantityReceived);
        $this->lines[] = $line;

        $this->recordThat(
            new ReceiptNoteLineAdded($this->id, $this->purchaseOrderId, $line, new \DateTimeImmutable())
        );
    }

    public function id(): AggregateId
    {
        return $this->id;
    }
}
