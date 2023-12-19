<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use BadFunctionCallException;
use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;

use function assert;

final class History extends AbstractAction
{
    public function __construct(
        private readonly DeviceInterface $device,
        private readonly int $page = 0,
        private readonly int $lg = 50,
    ) {
        assert($this->device instanceof DeviceInterface);

        parent::__construct($device);
    }

    public function method(): string
    {
        return self::GET;
    }

    public function path(): string
    {
        return '/history';
    }

    public function sign(callable|null $generate = null): string
    {
        assert($generate === null);

        throw new BadFunctionCallException('This method is not supported.');
    }

    /** {@inheritdoc} */
    public function payload(): array
    {
        return [
            'page' => $this->page,
            'lg' => $this->lg,
        ];
    }
}
