<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

final class Status extends AbstractAction
{
    public function method(): string
    {
        return self::GET;
    }

    public function __toString(): string
    {
        return '';
    }
}
