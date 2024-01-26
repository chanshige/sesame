<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

use Chanshige\SmartLock\Sesame\Exception\SesameException;

interface ClientInterface
{
    public const MAJOR_VERSION = '2.0';

    /** @throws SesameException */
    public function __invoke(ActionInterface $action): ResponseInterface;
}
