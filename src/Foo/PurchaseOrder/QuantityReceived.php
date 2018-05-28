<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Assert\Assert;

final class QuantityReceived
{
    /** @var int */
    private $quantity;

    public function __construct(int $quantity)
    {
        Assert::that($quantity)->greaterOrEqualThan(0);
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
