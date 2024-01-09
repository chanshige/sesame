<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Interface;

use Chanshige\SmartLock\Sesame\Exception\SesameException;
use Chanshige\SmartLock\Sesame\Http\ResponseInterface;

interface ClientInterface
{
    /** @throws SesameException */
    public function __invoke(ActionInterface $action): ResponseInterface;

    public function status(DeviceInterface $device): ResponseInterface;

    public function history(DeviceInterface $device, int $page = 0, int $lg = 50): ResponseInterface;

    public function lock(DeviceInterface $device, string $note = 'WebAPI'): ResponseInterface;

    public function unLock(DeviceInterface $device, string $note = 'WebAPI'): ResponseInterface;

    public function toggle(DeviceInterface $device, string $note = 'WebAPI'): ResponseInterface;
}
