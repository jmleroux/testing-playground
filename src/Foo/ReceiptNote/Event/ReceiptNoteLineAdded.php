<?php
declare(strict_types=1);

namespace Foo\ReceiptNote\Event;

use DateTimeImmutable;

final class ReceiptNoteLineAdded
{
    private $createdAt;

    private $receiptNoteId;

    private $receiptNoteLine;

    public function __construct(ReceiptNoteId $receiptNoteId, ReceiptNoteLine $receiptNoteLine, DateTimeImmutable $createdAt)
    {
        $this->receiptNoteId = $receiptNoteId;
        $this->createdAt = $createdAt;
        $this->receiptNoteLine = $receiptNoteLine;
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
}
