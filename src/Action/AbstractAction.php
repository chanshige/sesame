<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

use Chanshige\SmartLock\Contracts\ActionInterface;

use function array_filter;
use function get_object_vars;

abstract class AbstractAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function payload(): array
    {
        $callback = static function (mixed $v): bool {
            return $v !== null;
        };

        return array_filter(get_object_vars($this), $callback);
    }
}
