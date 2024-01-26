<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Extend;

use Crypto\CMAC;
use Crypto\MACException;
use InvalidArgumentException;
use LogicException;

use function extension_loaded;
use function hex2bin;

if (! extension_loaded('crypto')) {
    throw new LogicException('You cannot use the "Chanshige\SmartLock\Sesame\Extend\AesCmac" as the "crypto" extension is not installed.');
}

final class AesCmac
{
    /**
     * Returns a MAC in hex encoding.
     */
    public static function hexDigest(string $key, string $data): string
    {
        try {
            $cmac = new CMAC(hex2bin($key), 'AES-128-CBC');
            $cmac->update(hex2bin($data));

            return $cmac->hexdigest();
        } catch (MACException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
