<?php

namespace App\Tests\Service;

use App\Model\Recruitis\Response\JobListingResponse;
use App\Tests\Helpers\TestData;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class DeserializationTest extends KernelTestCase
{
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        static::bootKernel();
        $this->serializer = $this->getContainer()->get(SerializerInterface::class);
    }

    /** @dataProvider provideJobListingCases */
    public function testDeserialization(string $jsonData): void
    {
        $this->serializer->deserialize($jsonData, JobListingResponse::class, 'json');
        // @phpstan-ignore method.alreadyNarrowedType
        $this->assertTrue(true);
    }

    /**
     * @return array<string[]>
     */
    public static function provideJobListingCases(): array
    {
        $cases = [
            TestData::validJobListing(),
            TestData::unauthorizedJobListing(),
        ];
        $dataset = [];

        foreach ($cases as [$data]) {
            $datasetEntry = [];
            $datasetEntry[] = $data;
            $dataset[] = $datasetEntry;
        }

        return $dataset;
    }
}
