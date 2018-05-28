<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Assert\Assert;

final class QuantityOrdered
{
    /** @var int */
    private $quantity;

    public function __construct(int $quantity)
    {
        Assert::that($quantity)->greaterOrEqualThan(1);
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
