<?php
declare(strict_types=1);

namespace Application\Subscriber;

use Domain\Model\Balance\Balance;
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

        //

        $purchaseOrder->processReceipt(
            $event->receiptNoteLine()->productId(),
            $event->receiptNoteLine()->quantityReceived()
        );

        // increase

        $this->purchaseOrderRepository->save($purchaseOrder);
    }
}
