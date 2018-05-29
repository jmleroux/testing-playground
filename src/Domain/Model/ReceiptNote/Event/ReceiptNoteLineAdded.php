<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote\Event;

use DateTimeImmutable;
use Domain\Model\PurchaseOrder\PurchaseOrderId;
use Domain\Model\ReceiptNote\ReceiptNoteId;
use Domain\Model\ReceiptNote\ReceiptNoteLine;

final class ReceiptNoteLineAdded
{
    private $createdAt;

    private $receiptNoteId;

    private $receiptNoteLine;
    private $purchaseOrderId;

    public function __construct(
        ReceiptNoteId $receiptNoteId,
        PurchaseOrderId $purchaseOrderId,
        ReceiptNoteLine $receiptNoteLine,
        DateTimeImmutable $createdAt
    ) {
        $this->receiptNoteId = $receiptNoteId;
        $this->createdAt = $createdAt;
        $this->receiptNoteLine = $receiptNoteLine;
        $this->purchaseOrderId = $purchaseOrderId;
    }

    public function receiptNoteId(): ReceiptNoteId
    {
        return $this->receiptNoteId;
    }

    public function receiptNoteLine(): ReceiptNoteLine
    {
        return $this->receiptNoteLine;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function purchaseOrderId(): PurchaseOrderId
    {
        return $this->purchaseOrderId;
    }
}
