<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Extend;

use GuzzleHttp\Utils;

final class Json
{
    /**
     * @param string $json    JSON data to parse
     * @param bool   $assoc   When true, returned objects will be converted into associative arrays.
     * @param int    $depth   User specified recursion depth.
     * @param int    $options Bitmask of JSON decode options.
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function decode(string $json, bool $assoc, int $depth = 512, int $options = 0): mixed
    {
        return Utils::jsonDecode($json, $assoc, $depth, $options);
    }
}
