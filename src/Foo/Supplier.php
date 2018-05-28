<?php
declare(strict_types=1);

namespace Foo;

final class Supplier
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
