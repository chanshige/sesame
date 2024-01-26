<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Http;

use Chanshige\SmartLock\Sesame\Interface\ClientInterface;
use Chanshige\SmartLock\Sesame\Interface\HttpInterface;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;

use function array_merge;
use function sprintf;

final class GuzzleHttpFactory
{
    /**
     * @param array<string, mixed> $config
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function newInstance(string $apiKey, array $config = []): HttpInterface
    {
        $stack = new HandlerStack(Utils::chooseHandler());
        $stack->push(Middleware::httpErrors(), 'http_errors');
        $stack->push(Middleware::prepareBody(), 'prepare_body');
        $stack->push(Middleware::mapRequest(static function (RequestInterface $request) use ($apiKey) {
            return $request->withHeader('x-api-key', $apiKey);
        }), 'sesame_api_key');

        if (! isset($config['headers'])) {
            $config['headers']['User-Agent'] = sprintf('SesameWebAPI/%s', ClientInterface::MAJOR_VERSION);
        }

        return new GuzzleHttp(new Client(array_merge(['handler' => $stack], $config)), new ResponseFactory());
    }
}
