<?php
declare(strict_types=1);

namespace Foo;


use Foo\ReceiptNote\Event\ReceiptNoteCreated;
use Foo\ReceiptNote\ReceiptNoteRepository;

class CreatedReceiptSubscriber
{
    /** @var ReceiptNoteRepository */
    private $receiptNoteRepository;

    public function __construct(ReceiptNoteRepository $receiptNoteRepository)
    {
        $this->receiptNoteRepository = $receiptNoteRepository;
    }

    public function __invoke(ReceiptNoteCreated $event)
    {
        $receiptNote = $this->receiptNoteRepository->getById($event->receiptNoteId());


        //        stdout(line(make_green('Aggregate created'), 'at', $event->createdAt()->format(DATE_ATOM)));
    }
}
