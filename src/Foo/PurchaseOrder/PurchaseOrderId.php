<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Common\AggregateId;
use Foo\Id;

final class PurchaseOrderId extends AggregateId
{
    use Id;
}
