<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Contracts;

interface SesameResponseInterface
{
    /** @return array<string, mixed> */
    public function headers(): array;

    public function statusCode(): int;

    public function body(): string;

    /** @return array<string, mixed> */
    public function toArray(): array;
}
