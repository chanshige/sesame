<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Enum;

enum Status: string
{
    case LOCKED = 'locked';
    case UNLOCKED = 'unlocked';

    /** @note サムターンが施錠・解錠判定範囲外の場合。半ロックとか？ */
    case MOVED = 'moved';

    public function message(): string
    {
        return match ($this) {
            self::LOCKED => '施錠',
            self::UNLOCKED => '解錠',
            self::MOVED => 'サムターン位置確認',
        };
    }

    public function equals(Status $status): bool
    {
        return $this === $status;
    }

    public function isNext(Status $status): bool
    {
        return $this->next() === $status;
    }

    public function next(): self
    {
        return match ($this) {
            self::LOCKED => self::UNLOCKED,
            self::UNLOCKED, self::MOVED => self::LOCKED,
        };
    }
}
