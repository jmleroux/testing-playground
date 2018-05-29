<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote;

use Common\AggregateNotFound;
use Common\AggregateRepository;

final class ReceiptNoteRepository extends AggregateRepository
{
    public function save(ReceiptNote $aggregate): void
    {
        $this->store($aggregate);
    }

    public function getById(ReceiptNoteId $receiptNoteId): ReceiptNote
    {
        $aggregate = $this->load((string)$receiptNoteId);

        if (!$aggregate instanceof ReceiptNote) {
            throw AggregateNotFound::with(ReceiptNote::class, (string)$receiptNoteId);
        }

        return $aggregate;
    }
}
