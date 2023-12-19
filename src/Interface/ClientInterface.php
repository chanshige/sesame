<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

use Chanshige\SmartLock\Sesame\Exception\SesameException;
use Chanshige\SmartLock\Sesame\Http\ResponseInterface;

interface ClientInterface
{
    /** @throws SesameException */
    public function __invoke(ActionInterface $action): ResponseInterface;
}
