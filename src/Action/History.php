<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

final class History extends AbstractAction
{
    protected int $page = 0;
    protected int $lg = 50;

    public function page(int $num): self
    {
        $this->page = $num;

        return $this;
    }

    public function lg(int $num): self
    {
        $this->lg = $num;

        return $this;
    }

    public function method(): string
    {
        return self::GET;
    }

    public function __toString(): string
    {
        return '/history';
    }
}
