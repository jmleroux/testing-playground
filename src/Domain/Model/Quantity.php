<?php
declare(strict_types=1);

namespace Domain\Model;

use Assert\Assert;

final class Quantity
{
    /** @var int */
    private $quantity;

    public function __construct(int $quantity)
    {
        Assert::that($quantity)->greaterOrEqualThan(0);
        $this->quantity = $quantity;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
