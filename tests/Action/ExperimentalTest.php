<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Action;

use Chanshige\SmartLock\Action\Experimental\Action;
use Chanshige\SmartLock\Action\Experimental\Key;
use Chanshige\SmartLock\Contracts\ActionInterface;
use Chanshige\SmartLock\Extend\Signature;
use Chanshige\SmartLock\Fake\FakeNow;
use PHPUnit\Framework\TestCase;

class ExperimentalTest extends TestCase
{
    public function testLock(): void
    {
        $fakeNow = new FakeNow();
        $action = new Key(Action::Lock, 'a13d4b890111676ba8fb36ece7e94f7d', 'test_lock', $fakeNow);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF9sb2Nr', $payload['history']);
        $this->assertSame(Signature::generate('a13d4b890111676ba8fb36ece7e94f7d', $fakeNow), $payload['sign']);
        $this->assertSame(82, $payload['cmd']);
    }

    public function testUnlock(): void
    {
        $fakeNow = new FakeNow();
        $action = new Key(Action::Unlock, 'a13d4b890111676ba8fb36ece7e94f7d', 'test_unlock', $fakeNow);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF91bmxvY2s=', $payload['history']);
        $this->assertSame(Signature::generate('a13d4b890111676ba8fb36ece7e94f7d', $fakeNow), $payload['sign']);
        $this->assertSame(83, $payload['cmd']);
    }

    public function testToggle(): void
    {
        $fakeNow = new FakeNow();
        $action = new Key(Action::Toggle, 'a13d4b890111676ba8fb36ece7e94f7d', 'test_toggle', $fakeNow);
        $this->assertInstanceOf(ActionInterface::class, $action);
        $this->assertSame('/cmd', (string) $action);
        $this->assertArrayHasKey('history', $payload = $action->payload());
        $this->assertArrayHasKey('sign', $payload);
        $this->assertArrayHasKey('cmd', $payload);
        $this->assertSame('dGVzdF90b2dnbGU=', $payload['history']);
        $this->assertSame(Signature::generate('a13d4b890111676ba8fb36ece7e94f7d', $fakeNow), $payload['sign']);
        $this->assertSame(88, $payload['cmd']);
    }
}
