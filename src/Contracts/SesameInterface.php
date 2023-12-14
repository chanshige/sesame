<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Contracts;

use Chanshige\SmartLock\Exception\SesameException;

interface SesameInterface
{
    /** @throws SesameException */
    public function __invoke(string $uuid, ActionInterface $action): SesameResponseInterface;
}
