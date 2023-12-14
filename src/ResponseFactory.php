<?php

declare(strict_types=1);

namespace Chanshige\SmartLock;

use Chanshige\SmartLock\Contracts\ResponseFactoryInterface;
use Chanshige\SmartLock\Contracts\SesameResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    public function create(PsrResponseInterface $response): SesameResponseInterface
    {
        return new SesameResponse($response);
    }
}
