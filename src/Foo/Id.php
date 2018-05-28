<?php
declare(strict_types=1);

namespace Foo;

use Ramsey\Uuid\Uuid;

trait Id
{
    /** @var string */
    private $value;

    public static function generate(): self
    {
        $uuid = Uuid::uuid4();

        return new static($uuid->toString());
    }

    public static function fromString(string $id): self
    {
        return new static($id);
    }

    private function __construct(string $uuid)
    {
        $this->value = $uuid;
    }
}
