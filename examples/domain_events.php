<?php
declare(strict_types=1);

namespace Example;

use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use Foo\CreatedReceiptSubscriber;
use Foo\Product\ProductId;
use Foo\PurchaseOrder\PurchaseOrder;
use Foo\PurchaseOrder\PurchaseOrderId;
use Foo\PurchaseOrder\PurchaseOrderRepository;
use Foo\PurchaseOrder\QuantityOrdered;
use Foo\PurchaseOrder\QuantityReceived;
use Foo\ReceiptNote\Event\ReceiptNoteCreated;
use Foo\ReceiptNote\Event\ReceiptNoteLineAdded;
use Foo\ReceiptNote\ReceiptNote;
use Foo\ReceiptNote\ReceiptNoteId;
use Foo\ReceiptNote\ReceiptNoteRepository;
use Foo\Supplier;

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

$purchaseOrderRepository = new PurchaseOrderRepository($eventDispatcher);
$receiptNoteRepository = new ReceiptNoteRepository($eventDispatcher);

$eventDispatcher->subscribeToAllEvents(new EventCliLogger());
$eventDispatcher->registerSubscriber(ExampleAggregateCreated::class, new ExampleAggregateCreatedSubscriber());
$eventDispatcher->registerSubscriber(ReceiptNoteLineAdded::class, new CreatedReceiptSubscriber($purchaseOrderRepository));

$productIdA = ProductId::generate();
$productIdB = ProductId::generate();
$productIdC = ProductId::generate();

$purchaseOrder = new PurchaseOrder(PurchaseOrderId::generate(), new Supplier('foo', 'bar'));
$purchaseOrder->addLine($productIdA, new QuantityOrdered(5));
$purchaseOrder->addLine($productIdB, new QuantityOrdered(1));
$purchaseOrder->addLine($productIdC, new QuantityOrdered(3));
$purchaseOrder->place();

$purchaseOrderRepository->save($purchaseOrder);


$receiptNote = new ReceiptNote(
    ReceiptNoteId::generate(),
    $purchaseOrder->id()
);

$receiptNote->addLine(
    $productIdA,
    new QuantityReceived(5)
);

$receiptNote->addLine(
    $productIdC,
    new QuantityReceived(1)
);

$receiptNoteRepository->save($receiptNote);

dump($purchaseOrder);
