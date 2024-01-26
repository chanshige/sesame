<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use Chanshige\SmartLock\Sesame\Extend\Signature;
use Chanshige\SmartLock\Sesame\Interface\ActionInterface;
use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;
use Chanshige\SmartLock\Sesame\Interface\NowInterface;
use Koriym\HttpConstants\Method;

abstract class AbstractAction implements ActionInterface
{
    public const GET = Method::GET;
    public const POST = Method::POST;

    public function __construct(
        private readonly DeviceInterface $device,
    ) {
    }

    public function uuid(): string
    {
        return $this->device->uuid();
    }

    public function secretKey(): string
    {
        return $this->device->secretKey();
    }

    abstract public function method(): string;

    abstract public function path(): string;

    /** @return array<string, string|int>|array{} */
    abstract public function payload(): array;

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    protected function sign(NowInterface $now): string
    {
        return Signature::generate($this->secretKey(), $now);
    }
}
