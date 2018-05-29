<?php
declare(strict_types=1);

namespace Domain\Model\Balance;

use Domain\Model\Product\ProductId;

final class Balance
{
    /** @var ProductId */
    private $productId;

    public static function create(ProductId $productId)
    {
        return new self::$this->__construct($productId);
    }

    private function __construct(ProductId $productId)
    {
        $this->productId = $productId;
    }
}
