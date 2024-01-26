<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

use Chanshige\SmartLock\Sesame\Device;
use Chanshige\SmartLock\Sesame\Extend\Signature;
use Chanshige\SmartLock\Sesame\Fake\FakeNow;
use Chanshige\SmartLock\Sesame\Interface\ActionInterface;
use Chanshige\SmartLock\Sesame\Interface\DeviceInterface;
use Chanshige\SmartLock\Sesame\Interface\NowInterface;
use Koriym\HttpConstants\Method;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ActionTest extends TestCase
{
    private DeviceInterface $device;
    private NowInterface $now;
    private string $uuid = '488ABAAB-164F-7A86-595F-DDD778CB86C3';
    private string $secretKey = 'a13d4b890111676ba8fb36ece7e94f7d';

    protected function setUp(): void
    {
        $this->now = new FakeNow();

        $this->device = new Device(
            $this->uuid,
            $this->secretKey,
        );
    }

    public function testHistory(): void
    {
        $action = new History($this->device);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(Method::GET, $action->method());
        $this->assertSame('/history', $action->path());
        $this->assertSame(['page' => 0, 'lg' => 50], $action->payload());
    }

    public function testHistoryWithCondition(): void
    {
        $action = new History($this->device, 5, 10);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(['page' => 5, 'lg' => 10], $action->payload());
    }

    public function testStatus(): void
    {
        $action = new Status($this->device);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(Method::GET, $action->method());
        $this->assertSame('', $action->path());
        $this->assertSame([], $action->payload());
    }

    public function testLockCommand(): void
    {
        $action = new Lock($this->device, 'test_lock', $this->now);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', $action->path());
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF9sb2Nr', $payload['history']);
        $this->assertSame(Signature::generate($this->secretKey, $this->now), $payload['sign']);
        $this->assertSame(CmdCode::LOCK, $payload['cmd']);
    }

    public function testUnlockCommand(): void
    {
        $action = new Unlock($this->device, 'test_unlock', $this->now);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', $action->path());
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF91bmxvY2s=', $payload['history']);
        $this->assertSame(Signature::generate($this->secretKey, $this->now), $payload['sign']);
        $this->assertSame(CmdCode::UNLOCK, $payload['cmd']);
    }

    public function testToggleCommand(): void
    {
        $action = new Toggle($this->device, 'test_toggle', $this->now);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', $action->path());
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF90b2dnbGU=', $payload['history']);
        $this->assertSame(Signature::generate($this->secretKey, $this->now), $payload['sign']);
        $this->assertSame(CmdCode::TOGGLE, $payload['cmd']);
    }
}
