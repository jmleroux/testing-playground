<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Common\AggregateId;
use Domain\Model\Id;

final class PurchaseOrderId extends AggregateId
{
    use Id;
}
