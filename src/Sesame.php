<?php

declare(strict_types=1);

namespace Chanshige\SmartLock;

use Chanshige\SmartLock\Client\GuzzleClientFactory;
use Chanshige\SmartLock\Contracts\ActionInterface;
use Chanshige\SmartLock\Contracts\ClientInterface;
use Chanshige\SmartLock\Contracts\ResponseInterface;
use Chanshige\SmartLock\Contracts\SesameInterface;
use Chanshige\SmartLock\Exception\ClientException;
use Chanshige\SmartLock\Exception\SesameException;

use function sprintf;

final class Sesame implements SesameInterface
{
    public function __construct(
        private ClientInterface $client
    ) {
    }

    public function __invoke(string $uuid, ActionInterface $action): ResponseInterface
    {
        try {
            $endpoint = $this->buildUri($uuid, $action);
            $response = $this->client->request($action->method(), $endpoint, $action->payload());

            return new Response($response);
        } catch (ClientException $e) {
            throw new SesameException($e->getMessage(), (int) $e->getCode());
        }
    }

    /**
     * @param array<string, mixed> $options
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function newInstance(string $apiKey, array $options = []): self
    {
        return new self(GuzzleClientFactory::newInstance($apiKey, $options));
    }

    private function buildUri(string $uuid, ActionInterface $action): string
    {
        return sprintf('https://app.candyhouse.co/api/sesame2/%s%s', $uuid, (string) $action);
    }
}
