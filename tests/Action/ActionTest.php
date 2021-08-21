<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

use Chanshige\SmartLock\Contracts\ActionInterface;
use Chanshige\SmartLock\Extend\Signature;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    public function testHistory(): void
    {
        $action = new History();
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(ActionInterface::GET, $action->method());
        $this->assertSame('/history', (string) $action);
        $this->assertSame(['page' => 0, 'lg' => 50], $action->payload());
    }

    public function testHistoryWithCondition(): void
    {
        $action = (new History())->page(5)->lg(10);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(['page' => 5, 'lg' => 10], $action->payload());
    }

    public function testStatus(): void
    {
        $action = new Status();
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame(ActionInterface::GET, $action->method());
        $this->assertSame('', (string) $action);
        $this->assertSame([], $action->payload());
    }

    public function testLockCommand(): void
    {
        $action = new Lock('a13d4b890111676ba8fb36ece7e94f7d', 'test_lock');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF9sb2Nr', $payload['history']);
        $this->assertSame(Signature::generate('a13d4b890111676ba8fb36ece7e94f7d'), $payload['sign']);
        $this->assertSame(82, $payload['cmd']);
    }

    public function testUnlockCommand(): void
    {
        $action = new Unlock('a13d4b890111676ba8fb36ece7e94f7d', 'test_unlock');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF91bmxvY2s=', $payload['history']);
        $this->assertSame(Signature::generate('a13d4b890111676ba8fb36ece7e94f7d'), $payload['sign']);
        $this->assertSame(83, $payload['cmd']);
    }

    public function testToggleCommand(): void
    {
        $action = new Toggle('a13d4b890111676ba8fb36ece7e94f7d', 'test_toggle');
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF90b2dnbGU=', $payload['history']);
        $this->assertSame(Signature::generate('a13d4b890111676ba8fb36ece7e94f7d'), $payload['sign']);
        $this->assertSame(88, $payload['cmd']);
    }
}
