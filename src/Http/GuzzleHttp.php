<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Http;

use Chanshige\SmartLock\Sesame\Exception\ClientException;
use Chanshige\SmartLock\Sesame\Interface\HttpInterface;
use Chanshige\SmartLock\Sesame\Interface\ResponseFactoryInterface;
use Chanshige\SmartLock\Sesame\Interface\ResponseInterface;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Koriym\HttpConstants\Method;

use function count;

final readonly class GuzzleHttp implements HttpInterface
{
    public function __construct(
        private GuzzleClientInterface $client,
        private ResponseFactoryInterface $factory,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $method, string $url, array $params = []): ResponseInterface
    {
        try {
            $options = count($params) > 0 ? [$this->bodyType($method) => $params] : [];
            $response = $this->client->request($method, $url, $options);

            return $this->factory->create($response);
        } catch (GuzzleException $e) {
            throw new ClientException($e->getMessage(), $e->getCode());
        }
    }

    private function bodyType(string $method): string
    {
        return match ($method) {
            Method::GET => RequestOptions::QUERY,
            Method::POST => RequestOptions::JSON,
            default => RequestOptions::BODY,
        };
    }
}
