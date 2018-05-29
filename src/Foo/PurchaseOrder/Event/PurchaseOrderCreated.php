<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder\Event;

use Common\AggregateId;
use DateTimeImmutable;
use Foo\PurchaseOrder\PurchaseOrder;

final class PurchaseOrderCreated
{
    /** @var DateTimeImmutable */
    private $createdAt;
    /** @var PurchaseOrder */
    private $purchaseOrder;

    public function __construct(
        PurchaseOrder $receiptNoteLine,
        DateTimeImmutable $createdAt
    ) {
        $this->createdAt = $createdAt;
        $this->purchaseOrder = $receiptNoteLine;
    }

    public function receiptNoteId(): AggregateId
    {
        return $this->purchaseOrder->id();
    }

    public function receiptNoteLine(): PurchaseOrder
    {
        return $this->purchaseOrder;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
