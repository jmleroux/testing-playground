<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote;

use Domain\Model\Product\ProductId;
use Domain\Model\PurchaseOrder\PurchaseOrderId;
use Domain\Model\PurchaseOrder\QuantityReceived;
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
