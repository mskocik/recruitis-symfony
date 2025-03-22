<?php

namespace App\Tests\Service;

use App\Model\Recruitis\Enum\ResponseCode;
use App\Service\Recruitis\ApiFetcher;
use App\Tests\Helpers\TestData;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ApiFetcherTest extends KernelTestCase
{
    private Container $container;

    protected function setUp(): void
    {
        static::bootKernel();
        $this->container = $this->getContainer();
    }

    /** @dataProvider provideJobListingCases */
    public function testResponsePayload(ResponseInterface|callable $response): void
    {
        static $page = 1;
        $httpClient = new MockHttpClient($response);

        $apiFetcher = new ApiFetcher(
            $httpClient,
            $this->container->get(SerializerInterface::class),
            $this->container->get(CacheItemPoolInterface::class)
        );
        $response = $apiFetcher->getJobs($page++);

        match ($response->meta->code) {
            ResponseCode::FOUND => $this->assertIsArray($response->payload),
            default => $this->assertNull($response->payload),
        };
    }

    /**
     * @return array<array<MockResponse>>
     */
    public static function provideJobListingCases(): array
    {
        return [
            ...TestData::getListingTestCases(),
            TestData::transportExceptionResponse(),
        ];
    }
}
