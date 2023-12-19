<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Http;

use Chanshige\SmartLock\Sesame\Extend\Json;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final readonly class Response implements ResponseInterface
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
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function toArray(): array
    {
        return (array) Json::decode($this->body(), true);
    }
}
