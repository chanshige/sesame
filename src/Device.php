<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame;

use Chanshige\SmartLock\Sesame\Extend\Now;
use Chanshige\SmartLock\Sesame\Extend\Signature;
use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;
use Chanshige\SmartLock\Sesame\Interface\NowInterface;

use function is_callable;

final readonly class Device implements DeviceInterface
{
    public function __construct(
        private string $uuid,
        private string $secretKey,
        private NowInterface|null $now = new Now(),
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    public function sign(callable|null $generate = null): string
    {
        if (! is_callable($generate)) {
            return $this->sign(Signature::generate(...));
        }

        return $generate($this->secretKey, $this->now);
    }
}
