<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use BadFunctionCallException;

use function assert;

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

    public function sign(callable|null $generate = null): string
    {
        assert($generate === null);

        throw new BadFunctionCallException('This method is not supported.');
    }

    /** @return array{} */
    public function payload(): array
    {
        return [];
    }
}
