<?php

declare(strict_types=1);

namespace Chanshige\SmartLock;

use Chanshige\SmartLock\Client\GuzzleClientFactory;
use Chanshige\SmartLock\Contracts\ActionInterface;
use Chanshige\SmartLock\Contracts\ClientInterface;
use Chanshige\SmartLock\Contracts\ResponseFactoryInterface;
use Chanshige\SmartLock\Contracts\SesameInterface;
use Chanshige\SmartLock\Contracts\SesameResponseInterface;
use Chanshige\SmartLock\Exception\ClientException;
use Chanshige\SmartLock\Exception\SesameException;

use function sprintf;

final readonly class Sesame implements SesameInterface
{
    public function __construct(
        private ClientInterface $client,
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function __invoke(string $uuid, ActionInterface $action): SesameResponseInterface
    {
        try {
            $actionUri = $this->buildUri($uuid, $action);
            $response = $this->client->request($action->method(), $actionUri, $action->payload());

            return $this->responseFactory->create($response);
        } catch (ClientException $e) {
            throw new SesameException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param array<string, mixed> $options
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function newInstance(string $apiKey, array $options = []): self
    {
        return new self(GuzzleClientFactory::newInstance($apiKey, $options), new ResponseFactory());
    }

    private function buildUri(string $uuid, ActionInterface $action): string
    {
        return sprintf('https://app.candyhouse.co/api/sesame2/%s%s', $uuid, $action);
    }
}
