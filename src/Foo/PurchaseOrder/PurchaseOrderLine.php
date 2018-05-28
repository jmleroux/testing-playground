<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Foo\Product;

final class PurchaseOrderLine
{
    /** @var Product\ProductId */
    private $productId;
    /** @var QuantityOrdered */
    private $quantityOrdered;
    /** @var QuantityReceived */
    private $quantityReceived;
    /** @var int */
    private $lineNumber;

    public function __construct(Product\ProductId $productId, QuantityOrdered $quantityOrdered, QuantityReceived $quantityReceived)
    {
        $this->productId = $productId;
        $this->quantityOrdered = $quantityOrdered;
        $this->quantityReceived = $quantityReceived;
    }
}
