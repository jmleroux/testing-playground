<?php
declare(strict_types=1);

namespace Foo\ReceiptNote;

use Foo\Product\ProductId;
use Foo\PurchaseOrder\PurchaseOrderId;
use Foo\PurchaseOrder\QuantityReceived;
use PHPUnit\Framework\TestCase;

class ReceiptNoteTest extends TestCase
{
    /**
     * @test
     */
    public function it_adds_receipt_note_lines()
    {
        $productId = ProductId::generate();
        $receiptNoteId = ReceiptNoteId::generate();
        $purchaseOrderId = PurchaseOrderId::generate();

        $receiptNote = new ReceiptNote($receiptNoteId, $purchaseOrderId);

        $quantityReceived = new QuantityReceived(4);
        $receiptNote->addLine($productId, $quantityReceived);
    }
}
