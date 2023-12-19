<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Extend;

use Chanshige\SmartLock\Sesame\Interface\NowInterface;
use DateTimeImmutable;

final class Now implements NowInterface
{
    public function timestamp(): int
    {
        return (new DateTimeImmutable())->getTimestamp();
    }
}
