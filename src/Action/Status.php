<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

final class Status extends AbstractAction
{
    public function method(): string
    {
        return self::GET;
    }

    public function path(): string
    {
        return '';
    }

    /** @return array{} */
    public function payload(): array
    {
        return [];
    }
}
