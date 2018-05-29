<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder\Event;

use DateTimeImmutable;
use Domain\Model\PurchaseOrder\PurchaseOrderId;
use Domain\Model\PurchaseOrder\PurchaseOrderLine;

final class PurchaseOrderLineAdded
{
    private $createdAt;

    private $purchaseOrderId;

    private $purchaseOrderLine;

    public function __construct(
        PurchaseOrderId $purchaseOrderId,
        PurchaseOrderLine $purchaseOrderLine,
        DateTimeImmutable $createdAt
    ) {
        $this->purchaseOrderId = $purchaseOrderId;
        $this->createdAt = $createdAt;
        $this->purchaseOrderLine = $purchaseOrderLine;
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
