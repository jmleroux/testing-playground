<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder\Event;

use Common\AggregateId;
use DateTimeImmutable;
use Domain\Model\PurchaseOrder\PurchaseOrderId;

final class PurchaseOrderCreated
{
    /** @var DateTimeImmutable */
    private $createdAt;
    /** @var PurchaseOrderId */
    private $purchaseOrderId;

    public function __construct(
        PurchaseOrderId $receiptNoteLine,
        DateTimeImmutable $createdAt
    ) {
        $this->createdAt = $createdAt;
        $this->purchaseOrderId = $receiptNoteLine;
    }

    public function purchaseOrderId(): AggregateId
    {
        return $this->purchaseOrderId;
    }

    public function receiptNoteLine(): PurchaseOrderId
    {
        return $this->purchaseOrderId;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
