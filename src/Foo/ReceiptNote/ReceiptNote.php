<?php
declare(strict_types=1);

namespace Foo\ReceiptNote;

use Common\Aggregate;
use Common\AggregateId;
use Foo\Product\ProductId;
use Foo\PurchaseOrder\PurchaseOrderId;
use Foo\PurchaseOrder\QuantityReceived;
use Foo\ReceiptNote\Event\ReceiptNoteCreated;
use Foo\ReceiptNote\Event\ReceiptNoteLineAdded;

final class ReceiptNote extends Aggregate
{
    /** @var ReceiptNoteId */
    private $id;
    /** @var ReceiptNoteLine[] */
    private $lines = [];
    /** @var PurchaseOrderId */
    private $purchaseOrderId;

    public function __construct(ReceiptNoteId $id, PurchaseOrderId $purchaseOrderId)
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
            new ReceiptNoteLineAdded($this->id, $line, new \DateTimeImmutable())
        );
    }

    public function id(): AggregateId
    {
        return $this->id;
    }
}
