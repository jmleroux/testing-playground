<?php
declare(strict_types=1);

namespace Foo\ReceiptNote;

use Common\AggregateId;
use Foo\Id;

final class ReceiptNoteId extends AggregateId
{
    use Id;
}
