<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use BadFunctionCallException;

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

    public function uuid(): string
    {
        // 利用しないので呼び出された場合は例外
        throw new BadFunctionCallException('This method is not supported.');
    }

    /** @return array{} */
    public function payload(): array
    {
        return [];
    }
}
