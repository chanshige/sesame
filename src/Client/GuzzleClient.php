<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Client;

use Chanshige\SmartLock\Contracts\ActionInterface;
use Chanshige\SmartLock\Contracts\ClientInterface;
use Chanshige\SmartLock\Exception\ClientException;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

final class GuzzleClient implements ClientInterface
{
    public function __construct(
        private HttpClientInterface $client
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $method, string $url, array $params = []): ResponseInterface
    {
        try {
            return $this->client->request($method, $url, [$this->bodyType($method) => $params]);
        } catch (GuzzleException $e) {
            throw new ClientException($e->getMessage(), (int) $e->getCode());
        }
    }

    private function bodyType(string $method): string
    {
        return match ($method) {
            ActionInterface::GET => RequestOptions::QUERY,
            ActionInterface::POST => RequestOptions::JSON,
            default => RequestOptions::BODY,
        };
    }
}
