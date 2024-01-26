<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseFactoryInterface
{
    public function create(PsrResponseInterface $response): ResponseInterface;
}
