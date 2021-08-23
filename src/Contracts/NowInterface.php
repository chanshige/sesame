<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Contracts;

interface NowInterface
{
    public function timestamp(): int;
}
