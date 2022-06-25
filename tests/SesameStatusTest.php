<?php

declare(strict_types=1);

namespace Chanshige\SmartLock;

use Chanshige\SmartLock\Action\Status;
use Chanshige\SmartLock\Contracts\ClientInterface;
use Chanshige\SmartLock\Contracts\SesamiResponseInterface;
use Chanshige\SmartLock\Exception\ClientException;
use Chanshige\SmartLock\Exception\SesameException;
use Koriym\HttpConstants\StatusCode;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class SesameStatusTest extends TestCase
{
    /**
     * @dataProvider sampleDataProvider
     */
    public function testOK(mixed $code, mixed $headers, mixed $body, mixed $formatted): void
    {
        $response = Mockery::mock(PsrResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn($code);
        $response->shouldReceive('getHeaders')->andReturn($headers);
        $response->shouldReceive('getBody')->andReturn($body);

        $client = Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')
            ->once()
            ->andReturnUsing(function (string $method, string $uri, array $params) use ($response) {
                $this->assertSame('GET', $method);
                $this->assertSame('https://app.candyhouse.co/api/sesame2/488ABAAB-164F-7A86-595F-DDD778CB86C3', $uri);
                $this->assertSame([], $params);

                return $response;
            });

        $sesame = new Sesame($client, new ResponseFactory());
        $result = $sesame('488ABAAB-164F-7A86-595F-DDD778CB86C3', new Status());

        $this->assertInstanceOf(SesamiResponseInterface::class, $result);
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

        $client = Mockery::mock(ClientInterface::class);
        $client->shouldReceive('request')
            ->andThrow(ClientException::class, 'test_exception', 403);

        $sesame = new Sesame($client, new ResponseFactory());
        $sesame('488ABAAB-164F-7A86-595F-DDD778CB86C3', new Status());
    }

    /**
     * @return array<array<int, mixed>>
     */
    public function sampleDataProvider(): array
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
