<?php
declare(strict_types=1);

namespace Example;

use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use Domain\Model\CreatedReceiptSubscriber;
use Domain\Model\Product\ProductId;
use Domain\Model\PurchaseOrder\PurchaseOrder;
use Domain\Model\PurchaseOrder\PurchaseOrderId;
use Domain\Model\PurchaseOrder\PurchaseOrderRepository;
use Domain\Model\PurchaseOrder\QuantityOrdered;
use Domain\Model\PurchaseOrder\QuantityReceived;
use Domain\Model\ReceiptNote\Event\ReceiptNoteCreated;
use Domain\Model\ReceiptNote\Event\ReceiptNoteLineAdded;
use Domain\Model\ReceiptNote\ReceiptNote;
use Domain\Model\ReceiptNote\ReceiptNoteId;
use Domain\Model\ReceiptNote\ReceiptNoteRepository;
use Domain\Model\Supplier;

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
