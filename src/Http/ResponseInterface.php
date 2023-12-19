<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Http;

interface ResponseInterface
{
    /** @return array<string, array<int, string|int>> */
    public function headers(): array;

    public function statusCode(): int;

    public function body(): string;

    /** @return array<string, string|int|null> */
    public function toArray(): array;
}
