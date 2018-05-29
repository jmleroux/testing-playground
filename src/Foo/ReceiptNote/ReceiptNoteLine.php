<?php
declare(strict_types=1);

namespace Foo\ReceiptNote;


use Foo\Product\ProductId;
use Foo\PurchaseOrder\QuantityReceived;

final class ReceiptNoteLine
{
    /** @var ProductId */
    private $productId;
    /** @var QuantityReceived */
    private $quantityReceived;


    public function __construct(ProductId $productId, QuantityReceived $quantityReceived)
    {
        $this->productId = $productId;
        $this->quantityReceived = $quantityReceived;
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    public function quantityReceived(): QuantityReceived
    {
        return $this->quantityReceived;
    }
}
