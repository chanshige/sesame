<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame;

use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;

readonly class Device implements DeviceInterface
{
    public function __construct(
        private string $uuid,
        private string $secretKey,
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function secretKey(): string
    {
        return $this->secretKey;
    }
}
