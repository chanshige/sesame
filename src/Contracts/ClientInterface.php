<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    /**
     * @param array<string, mixed> $params
     */
    public function request(string $method, string $url, array $params = []): ResponseInterface;
}
