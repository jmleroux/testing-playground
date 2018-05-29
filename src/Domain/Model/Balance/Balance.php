<?php
declare(strict_types=1);

namespace Domain\Model\Balance;

use Domain\Model\Product\ProductId;
use Domain\Model\Quantity;

final class Balance
{
    /** @var ProductId */
    private $id;
    /** @var Quantity */
    private $quantity;

    public static function create(ProductId $id, Quantity $quantity)
    {
        return new self::$this->__construct($id, $quantity);
    }

    private function __construct(ProductId $id, Quantity $quantity)
    {
        $this->id = $id;
        $this->name = $quantity;
    }
}
