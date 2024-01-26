<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame;

use Chanshige\SmartLock\Sesame\Exception\ClientException;
use Chanshige\SmartLock\Sesame\Exception\SesameException;
use Chanshige\SmartLock\Sesame\Http\GuzzleHttpFactory;
use Chanshige\SmartLock\Sesame\Interface\ActionInterface;
use Chanshige\SmartLock\Sesame\Interface\ClientInterface;
use Chanshige\SmartLock\Sesame\Interface\HttpInterface;
use Chanshige\SmartLock\Sesame\Interface\ResponseInterface;

use function sprintf;

final readonly class Client implements ClientInterface
{
    public function __construct(
        private HttpInterface $client,
    ) {
    }

    public function __invoke(ActionInterface $action): ResponseInterface
    {
        try {
            return $this->client->request(
                $action->method(),
                $this->buildUri($action->uuid(), $action->path()),
                $action->payload(),
            );
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
        return new self(GuzzleHttpFactory::newInstance($apiKey, $options));
    }

    private function buildUri(string $uuid, string $path): string
    {
        return sprintf('https://app.candyhouse.co/api/sesame2/%s%s', $uuid, $path);
    }
}
