<?php

declare(strict_types=1);

namespace Chanshige\SmartLock;

use Chanshige\SmartLock\Contracts\ResponseFactoryInterface;
use Chanshige\SmartLock\Contracts\SesamiResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    public function create(PsrResponseInterface $response): SesamiResponseInterface
    {
        return new SesamiResponse($response);
    }
}
