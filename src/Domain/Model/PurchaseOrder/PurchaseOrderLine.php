<?php
declare(strict_types=1);

namespace Domain\Model\PurchaseOrder;

use Domain\Model\Product;

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

    public function __construct(
        Product\ProductId $productId,
        QuantityOrdered $quantityOrdered,
        QuantityReceived $quantityReceived,
        int $lineNumber
    ) {
        $this->productId = $productId;
        $this->quantityOrdered = $quantityOrdered;
        $this->quantityReceived = $quantityReceived;
        $this->lineNumber = $lineNumber;
    }

    /**
     * @return int
     */
    public function getLineNumber(): int
    {
        return $this->lineNumber;
    }

    public function getProductId(): Product\ProductId
    {
        return $this->productId;
    }

    public function addQuantityReceived(QuantityReceived $quantityReceived)
    {
        $this->quantityReceived = new QuantityReceived(
            $this->quantityReceived->getQuantity() + $quantityReceived->getQuantity()
        );
    }
}
