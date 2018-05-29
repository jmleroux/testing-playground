<?php
declare(strict_types=1);

namespace Domain\Model;

use Domain\Model\PurchaseOrder\PurchaseOrderRepository;
use Domain\Model\ReceiptNote\Event\ReceiptNoteLineAdded;

class CreatedReceiptSubscriber
{
    private $purchaseOrderRepository;

    public function __construct(PurchaseOrderRepository $purchaseOrderRepository)
    {
        $this->purchaseOrderRepository = $purchaseOrderRepository;
    }

    public function __invoke(ReceiptNoteLineAdded $event)
    {
        $purchaseOrder = $this->purchaseOrderRepository->getById($event->purchaseOrderId());

        $purchaseOrder->processReceipt(
            $event->receiptNoteLine()->productId(),
            $event->receiptNoteLine()->quantityReceived()
        );

        $this->purchaseOrderRepository->save($purchaseOrder);
    }
}
