<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use Chanshige\SmartLock\Sesame\Interface\ActionInterface;
use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;
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

    public function sign(callable|null $generate = null): string
    {
        return $this->device->sign($generate);
    }

    abstract public function method(): string;

    abstract public function path(): string;

    /** @return array<string, string|int>|array{} */
    abstract public function payload(): array;
}
