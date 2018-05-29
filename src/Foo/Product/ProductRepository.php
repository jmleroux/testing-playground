<?php
declare(strict_types=1);

namespace Foo\PurchaseOrder;

use Common\AggregateNotFound;
use Common\AggregateRepository;
use Foo\Product\Product;
use Foo\Product\ProductId;

final class ProductRepository extends AggregateRepository
{
    public function save(Product $aggregate): void
    {
        $this->store($aggregate);
    }

    public function getById(ProductId $productId): Product
    {
        $aggregate = $this->load((string)$productId);

        if (!$aggregate instanceof Product) {
            throw AggregateNotFound::with(Product::class, (string)$productId);
        }

        return $aggregate;
    }
}
