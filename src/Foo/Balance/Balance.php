<?php
declare(strict_types=1);

namespace Foo\Balance;

use Foo\Product\ProductId;
use Foo\Quantity;

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
