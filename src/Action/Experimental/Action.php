<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action\Experimental;

enum Action: int
{
    case Lock = 82;
    case Unlock = 83;
    case Toggle = 88;

    public function label(): string
    {
        return match ($this) {
            self::Lock => 'lock',
            self::Unlock => 'unlock',
            self::Toggle => 'toggle',
        };
    }

    public function equals(Action $action): bool
    {
        return $this === $action;
    }
}
