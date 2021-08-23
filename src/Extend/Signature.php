<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Extend;

use Chanshige\SmartLock\Contracts\NowInterface;

use function bin2hex;
use function substr;

final class Signature
{
    public static function generate(string $keyHex, NowInterface $now): string
    {
        return AesCmac::hexdigest($keyHex, substr(bin2hex(UInt32LE::pack($now->timestamp())), 2, 8));
    }
}
