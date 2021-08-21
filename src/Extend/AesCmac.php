<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Extend;

use Crypto\CMAC;
use Crypto\MACException;
use InvalidArgumentException;

use function hex2bin;

final class AesCmac
{
    private const ALGORITHM = 'AES-128-CBC';

    /**
     * Returns a MAC in hex encoding.
     */
    public static function hexdigest(string $key, string $data): string
    {
        try {
            $cmac = new CMAC(hex2bin($key), self::ALGORITHM);
            $cmac->update(hex2bin($data));

            return $cmac->hexdigest();
        } catch (MACException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
