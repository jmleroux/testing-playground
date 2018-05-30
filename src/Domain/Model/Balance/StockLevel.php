<?php
declare(strict_types=1);

namespace Domain\Model\Balance;

use Domain\Model\PurchaseOrder\QuantityReceived;

class StockLevel
{
    private $quantity;

    public function increase(QuantityReceived $quantityReceived)
    {
        $this->quantity += $quantityReceived->getQuantity();
    }
}
