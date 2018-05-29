<?php
declare(strict_types=1);

namespace Foo\Product;

use Common\AggregateId;
use Foo\Id;

final class ProductId extends AggregateId
{
    use Id;
}
