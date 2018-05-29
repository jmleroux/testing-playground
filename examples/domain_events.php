<?php
declare(strict_types=1);

namespace Example;

use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use Foo\Product\ProductId;
use Foo\PurchaseOrder\PurchaseOrder;
use Foo\PurchaseOrder\PurchaseOrderId;
use Foo\PurchaseOrder\QuantityReceived;
use Foo\ReceiptNote\ReceiptNote;
use Foo\ReceiptNote\ReceiptNoteId;
use Foo\ReceiptNote\ReceiptNoteRepository;

require __DIR__ . '/../bootstrap.php';

//$eventDispatcher = new EventDispatcher();
//$eventDispatcher->subscribeToAllEvents(new EventCliLogger());
//$eventDispatcher->registerSubscriber(ExampleAggregateCreated::class, new ExampleAggregateCreatedSubscriber());
//
//$exampleAggregateRepository = new ExampleAggregateRepository($eventDispatcher);
//
//$aggregate = new ExampleAggregate(
//    $exampleAggregateRepository->nextIdentity()
//);
//
//$exampleAggregateRepository->save($aggregate);



$eventDispatcher = new EventDispatcher();
$eventDispatcher->subscribeToAllEvents(new EventCliLogger());
//$eventDispatcher->registerSubscriber(ExampleAggregateCreated::class, new ExampleAggregateCreatedSubscriber());

$receiptNoteRepository = new ReceiptNoteRepository($eventDispatcher);

$receiptNote = new ReceiptNote(
    ReceiptNoteId::generate(),
    PurchaseOrderId::generate()
);

$receiptNote->addLine(
    ProductId::generate(),
    new QuantityReceived(5)
);

$receiptNote->addLine(
    ProductId::generate(),
    new QuantityReceived(1)
);

$receiptNoteRepository->save($receiptNote);
