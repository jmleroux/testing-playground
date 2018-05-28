<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Foo\Supplier;

final class PurchaseOrder
{
    /** @var PurchaseOrderId */
    private $id;
    /** @var PurchaseOrderLine[] */
    private $lines;
    /** @var Supplier */
    private $supplier;

    public function __construct(PurchaseOrderId $id, iterable $lines, Supplier $supplier)
    {
        $this->id = $id;
        $this->supplier = $supplier;

        $this->lines = (function (PurchaseOrderLine ...$line) {
            return $line;
        })(...$lines);
    }

    public function getLineByNumber(int $lineNumber): PurchaseOrderLine
    {

    }
}
