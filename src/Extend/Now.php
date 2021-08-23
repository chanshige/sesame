<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Extend;

use Chanshige\SmartLock\Contracts\NowInterface;
use DateTimeImmutable;

final class Now implements NowInterface
{
    public function timestamp(): int
    {
        return (new DateTimeImmutable())->getTimestamp();
    }
}
