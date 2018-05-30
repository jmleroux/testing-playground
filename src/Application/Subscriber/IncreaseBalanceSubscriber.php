<?php

declare(strict_types=1);

namespace Application\Subscriber;

use Domain\Model\PurchaseOrder\BalanceRepository;
use Domain\Model\ReceiptNote\Event\ReceiptNoteLineAdded;

class IncreaseBalanceSubscriber
{
    private $balanceRepository;

    public function __construct(BalanceRepository $balanceRepository)
    {
        $this->balanceRepository = $balanceRepository;
    }

    public function __invoke(ReceiptNoteLineAdded $event)
    {
        $balance = $this->balanceRepository->getByProductId($event->receiptNoteLine()->productId());
        $balance->increase($event->receiptNoteLine()->quantityReceived());

        $this->balanceRepository->save($balance);
    }
}
