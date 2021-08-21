<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Extend;

use function bin2hex;
use function substr;

final class Signature
{
    public static function generate(string $keyHex): string
    {
        return AesCmac::hexdigest($keyHex, substr(bin2hex(UInt32LE::pack(Timestamp::now())), 2, 8));
    }
}
