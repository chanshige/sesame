<?php

declare(strict_types=1);

namespace Chanshige\SmartLock;

use Chanshige\SmartLock\Contracts\SesameResponseInterface;
use Chanshige\SmartLock\Extend\Json;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final readonly class SesameResponse implements SesameResponseInterface
{
    public function __construct(
        private PsrResponseInterface $response,
    ) {
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * {@inheritdoc}
     */
    public function headers(): array
    {
        return $this->response->getHeaders();
    }

    public function body(): string
    {
        return (string) $this->response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return (array) Json::decode($this->body(), true);
    }
}
