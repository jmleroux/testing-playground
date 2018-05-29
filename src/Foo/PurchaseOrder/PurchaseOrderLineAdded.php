<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use DateTimeImmutable;

final class PurchaseOrderLineAdded
{
    private $createdAt;

    private $purchaseOrderId;

    private $purchaseOrderLine;

    public function __construct(PurchaseOrderId $receiptNoteId, PurchaseOrderLine $receiptNoteLine, DateTimeImmutable $createdAt)
    {
        $this->purchaseOrderId = $receiptNoteId;
        $this->createdAt = $createdAt;
        $this->purchaseOrderLine = $receiptNoteLine;
    }

    public function receiptNoteId(): PurchaseOrderId
    {
        return $this->purchaseOrderId;
    }

    public function receiptNoteLine(): PurchaseOrderLine
    {
        return $this->purchaseOrderLine;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
