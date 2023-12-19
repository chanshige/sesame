<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

use Chanshige\SmartLock\Sesame\Http\ResponseInterface;

interface HttpInterface
{
    /** @param array<string, string|int> $params */
    public function request(string $method, string $url, array $params = []): ResponseInterface;
}
