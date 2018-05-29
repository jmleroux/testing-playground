<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote\Event;

use DateTimeImmutable;
use Domain\Model\ReceiptNote\ReceiptNoteId;

final class ReceiptNoteCreated
{
    private $createdAt;

    private $receiptNoteId;

    public function __construct(ReceiptNoteId $receiptNoteId, DateTimeImmutable $createdAt)
    {
        $this->receiptNoteId = $receiptNoteId;
        $this->createdAt = $createdAt;
    }

    public function receiptNoteId(): ReceiptNoteId
    {
        return $this->receiptNoteId;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
