<?php
declare(strict_types=1);

namespace Foo\Product;

final class Product
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
}
