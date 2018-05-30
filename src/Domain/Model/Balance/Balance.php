<?php
declare(strict_types=1);

namespace Domain\Model\Balance;

use Common\Aggregate;
use Common\AggregateId;
use Domain\Model\Product\ProductId;
use Domain\Model\PurchaseOrder\QuantityReceived;

final class Balance extends Aggregate
{
    /** @var ProductId */
    private $productId;

    /** @var StockLevel */
    private $stockLevel;

    public static function create(ProductId $productId)
    {
        return new self::$this->__construct($productId);
    }

    public function increase(QuantityReceived $quantityReceived): void
    {
        $this->stockLevel->increase($quantityReceived);
    }

    private function __construct(ProductId $productId)
    {
        $this->productId = $productId;
        $this->stockLevel = new StockLevel();
    }

    public function id(): AggregateId
    {
        return $this->productId;
    }
}
