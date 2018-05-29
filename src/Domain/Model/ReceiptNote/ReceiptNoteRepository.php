<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote;

use Common\AggregateNotFound;
use Common\AggregateRepository;
use Domain\Model\Product\ProductId;

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

    public function getByProductId(ProductId $productId): array
    {
        $linesForProduct = [];
        /** @var ReceiptNote $receiptNote */
        foreach ($this->objects as $receiptNote)
        {

            $lines[] = $receiptNote->getLinesByProductId($productId);
        }

        return [];
    }
}
