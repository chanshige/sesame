<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Http;

use Chanshige\SmartLock\Sesame\Interface\ResponseFactoryInterface;
use Chanshige\SmartLock\Sesame\Interface\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    public function create(PsrResponseInterface $response): ResponseInterface
    {
        return new Response($response);
    }
}
