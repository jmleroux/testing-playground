<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Common\AggregateNotFound;
use Common\AggregateRepository;
use Domain\Model\Balance\Balance;
use Domain\Model\Balance\StockLevel;
use Domain\Model\Product\Product;
use Domain\Model\Product\ProductId;

final class BalanceRepository extends AggregateRepository
{
    public function save(Balance $aggregate): void
    {
        $this->store($aggregate);
    }

    public function getByProductId(ProductId $productId): Balance
    {
        $aggregate = $this->load((string)$productId);

        if (!$aggregate instanceof Balance) {
            return Balance::create($productId);
        }

        return $aggregate;
    }
}
