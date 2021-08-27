<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Client;

use Chanshige\SmartLock\Contracts\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;

use function array_merge;

final class GuzzleClientFactory
{
    /**
     * @param array<string, mixed> $config
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function newInstance(string $apiKey, array $config = []): ClientInterface
    {
        $stack = new HandlerStack(Utils::chooseHandler());
        $stack->push(Middleware::httpErrors(), 'http_errors');
        $stack->push(Middleware::prepareBody(), 'prepare_body');
        $stack->push(Middleware::mapRequest(static function (RequestInterface $request) use ($apiKey) {
            return $request->withHeader('x-api-key', $apiKey);
        }), 'add_api_key');

        return new GuzzleClient(new Client(array_merge(['handler' => $stack], $config)));
    }
}
