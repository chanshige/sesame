<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

interface NowInterface
{
    public function timestamp(): int;
}
