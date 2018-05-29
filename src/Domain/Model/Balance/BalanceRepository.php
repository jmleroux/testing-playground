<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Common\AggregateNotFound;
use Common\AggregateRepository;
use Domain\Model\Balance\Balance;

final class BalanceRepository extends AggregateRepository
{
    public function save(Balance $aggregate): void
    {
        $this->store($aggregate);
    }
}
