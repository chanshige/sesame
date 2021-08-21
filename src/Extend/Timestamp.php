<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Extend;

use DateTimeImmutable;

final class Timestamp
{
    public static function now(): int
    {
        return (new DateTimeImmutable())->getTimestamp();
    }
}
