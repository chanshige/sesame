<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Extend;

use Chanshige\SmartLock\Sesame\Interface\NowInterface;

use function bin2hex;
use function pack;
use function substr;

final class Signature
{
    /** @SuppressWarnings(PHPMD.StaticAccess) */
    public static function generate(string $keyHex, NowInterface $now): string
    {
        return AesCmac::hexDigest($keyHex, substr(bin2hex(pack('V', $now->timestamp())), 2, 8));
    }
}
