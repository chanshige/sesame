<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Contracts;

use Koriym\HttpConstants\Method;
use Stringable;

interface ActionInterface extends Stringable
{
    public const GET = Method::GET;
    public const POST = Method::POST;

    public function method(): string;

    /**
     * @return array<string, mixed>
     */
    public function payload(): array;
}
