<?php
declare(strict_types=1);

namespace Domain\Model\ReceiptNote;

use Common\AggregateId;
use Domain\Model\Id;

final class ReceiptNoteId extends AggregateId
{
    use Id;
}
