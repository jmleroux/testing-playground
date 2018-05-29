<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Common\AggregateNotFound;
use Common\AggregateRepository;

final class PurchaseOrderRepository extends AggregateRepository
{
    public function save(PurchaseOrder $aggregate): void
    {
        $this->store($aggregate);
    }

    public function getById(PurchaseOrderId $receiptNoteId): PurchaseOrder
    {
        $aggregate = $this->load((string)$receiptNoteId);

        if (!$aggregate instanceof PurchaseOrder) {
            throw AggregateNotFound::with(PurchaseOrder::class, (string)$receiptNoteId);
        }

        return $aggregate;
    }
}
