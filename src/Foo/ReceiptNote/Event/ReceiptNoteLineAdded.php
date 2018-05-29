<?php
declare(strict_types=1);

namespace Foo\ReceiptNote\Event;

use DateTimeImmutable;
use Foo\PurchaseOrder\PurchaseOrderId;
use Foo\ReceiptNote\ReceiptNoteId;
use Foo\ReceiptNote\ReceiptNoteLine;

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
