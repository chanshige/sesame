<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

use Chanshige\SmartLock\Sesame\Http\Response;
use Chanshige\SmartLock\Sesame\Http\ResponseFactoryInterface;
use Chanshige\SmartLock\Sesame\Http\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    public function create(PsrResponseInterface $response): ResponseInterface
    {
        return new Response($response);
    }
}
