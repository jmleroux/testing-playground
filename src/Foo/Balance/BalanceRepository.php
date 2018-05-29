<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Common\AggregateNotFound;
use Common\AggregateRepository;
use Foo\Balance\Balance;

final class BalanceRepository extends AggregateRepository
{
    public function save(Balance $aggregate): void
    {
        $this->store($aggregate);
    }
}
