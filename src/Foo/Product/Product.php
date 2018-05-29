<?php
declare(strict_types=1);

namespace Foo\Product;

use Common\Aggregate;
use Common\AggregateId;

final class Product extends Aggregate
{
    /** @var string */
    private $name;
    /** @var ProductId */
    private $id;

    public function __construct(ProductId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): AggregateId
    {
        return $this->id;
    }
}
