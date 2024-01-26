<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

interface DeviceInterface
{
    public function uuid(): string;

    public function secretKey(): string;
}
