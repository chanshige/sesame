<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

use Chanshige\SmartLock\Contracts\NowInterface;
use Chanshige\SmartLock\Extend\Now;
use Chanshige\SmartLock\Extend\Signature;

use function base64_encode;

final class Toggle extends AbstractAction
{
    protected int $cmd = 88;
    protected string $history;
    protected string $sign;

    public function __construct(
        string $secretKey,
        string $comment = 'WebAPI',
        NowInterface|null $now = null,
    ) {
        $this->sign = Signature::generate($secretKey, ($now ?? new Now()));
        $this->history = base64_encode($comment);
    }

    public function method(): string
    {
        return self::POST;
    }

    public function __toString(): string
    {
        return '/cmd';
    }
}
