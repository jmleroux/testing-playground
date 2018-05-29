<?php
declare(strict_types=1);

namespace Domain\Model\Product;

use Common\AggregateId;
use Domain\Model\Id;

final class ProductId extends AggregateId
{
    use Id;
}
