<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action\Experimental;

use Chanshige\SmartLock\Action\AbstractAction;
use Chanshige\SmartLock\Contracts\NowInterface;
use Chanshige\SmartLock\Extend\Now;
use Chanshige\SmartLock\Extend\Signature;
use Override;

use function base64_encode;

final class Key extends AbstractAction
{
    protected int $cmd;
    protected string $history;
    protected string $sign;

    public function __construct(
        Action $action,
        string $secretKey,
        string $comment = 'WebAPI',
        NowInterface|null $now = null,
    ) {
        $this->cmd = $action->value;
        $this->history = base64_encode($comment);
        $this->sign = Signature::generate($secretKey, ($now ?? new Now()));
    }

    #[Override]
    public function method(): string
    {
        return self::POST;
    }

    public function __toString(): string
    {
        return '/cmd';
    }
}
