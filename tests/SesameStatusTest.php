<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame;

use Chanshige\SmartLock\Sesame\Action\Status;
use Chanshige\SmartLock\Sesame\Exception\ClientException;
use Chanshige\SmartLock\Sesame\Exception\SesameException;
use Chanshige\SmartLock\Sesame\Http\Response;
use Chanshige\SmartLock\Sesame\Interface\HttpInterface;
use Chanshige\SmartLock\Sesame\Interface\ResponseInterface;
use Koriym\HttpConstants\StatusCode;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class SesameStatusTest extends TestCase
{
    /** @dataProvider sampleDataProvider */
    public function testOK(mixed $code, mixed $headers, mixed $body, mixed $formatted): void
    {
        $response = Mockery::mock(PsrResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn($code);
        $response->shouldReceive('getHeaders')->andReturn($headers);
        $response->shouldReceive('getBody')->andReturn($body);

        $client = Mockery::mock(HttpInterface::class);
        $client->shouldReceive('request')
            ->once()
            ->andReturnUsing(function (string $method, string $uri, array $params) use ($response): ResponseInterface {
                $this->assertSame('GET', $method);
                $this->assertSame('https://app.candyhouse.co/api/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3', $uri);
                $this->assertSame([], $params);

                return new Response($response);
            });

        $sesame = new Client($client);
        $result = $sesame(new Status(new Device('488ABAAB-164F-7A86-595F-DDD778CB86C3', 'a13d4b890111676ba8fb36ece7e94f7d')));

        $this->assertInstanceOf(ResponseInterface::class, $result);
        $this->assertSame($code, $result->statusCode());
        $this->assertSame($headers, $result->headers());
        $this->assertSame($body, $result->body());
        $this->assertSame($formatted, $result->toArray());
    }

    public function testFailed(): void
    {
        $this->expectException(SesameException::class);
        $this->expectExceptionMessage('test_exception');
        $this->expectExceptionCode(403);

        $client = Mockery::mock(HttpInterface::class);
        $client->shouldReceive('request')
            ->andThrow(ClientException::class, 'test_exception', 403);

        $sesame = new Client($client);
        $sesame(new Status(new Device('488ABAAB-164F-7A86-595F-DDD778CB86C3', 'a13d4b890111676ba8fb36ece7e94f7d')));
    }

    /** @return array<array<int, mixed>> */
    public static function sampleDataProvider(): array
    {
        return [
            [
                StatusCode::OK,
                ['x-test_headers' => ['example_header']],
                '{"batteryPercentage":100,"batteryVoltage":6.109090909090909,"position":256,"CHSesame2Status":"unlocked","timestamp":1629561776,"wm2State":true}',
                [
                    'batteryPercentage' => 100,
                    'batteryVoltage' => 6.109090909090909,
                    'position' => 256,
                    'CHSesame2Status' => 'unlocked',
                    'timestamp' => 1629561776,
                    'wm2State' => true,
                ],
            ],
        ];
    }
}
