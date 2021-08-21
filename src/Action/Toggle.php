<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

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
    ) {
        $this->sign = Signature::generate($secretKey);
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
