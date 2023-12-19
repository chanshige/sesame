<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Http;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseFactoryInterface
{
    public function create(PsrResponseInterface $response): ResponseInterface;
}
