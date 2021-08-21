<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Extend;

use function pack;

final class UInt32LE
{
    public static function pack(int $input): string
    {
        return pack('V', $input);
    }
}
