<?php

namespace App\Tests\Service;

use App\Model\Recruitis\Enum\ResponseCode;
use App\Service\Recruitis\ApiFetcher;
use App\Tests\Helpers\TestData;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
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
    public function testResponsePayload(ResponseInterface $response): void
    {
        $httpClient = new MockHttpClient($response);

        $apiFetcher = new ApiFetcher($httpClient, $this->container->get(SerializerInterface::class));
        $response = $apiFetcher->getJobs(1);

        match ($response->meta->code) { 
            ResponseCode::FOUND => $this->assertIsArray($response->payload),
            default => $this->assertNull($response->payload)
        };
    }

    public static function provideJobListingCases(): array
    {
        return TestData::getListingTestCases();
    }
}
