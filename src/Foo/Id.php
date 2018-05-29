<?php
declare(strict_types=1);

namespace Foo;

use Ramsey\Uuid\Uuid;

trait Id
{
    public static function generate(): self
    {
        $uuid = Uuid::uuid4();

        return self::fromString($uuid->toString());
    }
}
