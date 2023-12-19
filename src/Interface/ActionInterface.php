<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

interface ActionInterface extends DeviceInterface
{
    public function __construct(DeviceInterface $device);

    public function method(): string;

    public function path(): string;

    /** @return array<string, mixed> */
    public function payload(): array;
}
