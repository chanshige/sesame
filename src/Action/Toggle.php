<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use Chanshige\SmartLock\Sesame\Extend\Now;
use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;
use Chanshige\SmartLock\Sesame\Interface\NowInterface;

use function assert;
use function base64_encode;

final class Toggle extends AbstractAction
{
    public function __construct(
        private readonly DeviceInterface $device,
        private readonly string $comment = 'WebAPI',
        private readonly NowInterface $now = new Now(),
    ) {
        assert($this->device instanceof DeviceInterface);

        parent::__construct($device);
    }

    public function method(): string
    {
        return self::POST;
    }

    public function path(): string
    {
        return '/cmd';
    }

    /** {@inheritdoc} */
    public function payload(): array
    {
        return [
            'cmd' => CmdCode::TOGGLE,
            'history' => base64_encode($this->comment),
            'sign' => $this->sign($this->now),
        ];
    }
}
