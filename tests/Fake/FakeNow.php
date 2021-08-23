<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Fake;

use Chanshige\SmartLock\Contracts\NowInterface;
use DateTimeImmutable;

final class FakeNow implements NowInterface
{
    public const VALUE = '1970-01-01 00:00:00';

    public function timestamp(): int
    {
        return (new DateTimeImmutable(self::VALUE))->getTimestamp();
    }
}
