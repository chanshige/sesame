<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;

use function base64_encode;

final class Unlock extends AbstractAction
{
    public function __construct(
        private readonly DeviceInterface $device,
        private readonly string $comment = 'WebAPI',
    ) {
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
            'cmd' => Cmd::UNLOCK->value,
            'history' => base64_encode($this->comment),
            'sign' => $this->device->sign(),
        ];
    }
}
