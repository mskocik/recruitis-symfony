<?php

declare(strict_types=1);

namespace App\Service\Recruitis;

use App\Model\Recruitis\Response\JobListingResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiFetcher
{
    public const API_URL_BASE = 'https://app.recruitis.io';

    public const JOB_LIST = '/api2/jobs';
    public const JOB_DETAIL = '/api2/jobs/%d';
    public const /* /jobs/{id} */
        JOB_FORM = '/api2/jobs/%d/form';
    public const /* /jobs/{id}/form */
        JOB_FORM_VALIDATE = '/api2/jobs/%d/form/validate';
    public const /* /jobs/{id}/form/validate */
        ANSWERS = '/api2/answers';

    public function __construct(
        private HttpClientInterface $recruitisClient,
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getJobs(int $page, int $pageSize = 10): JobListingResponse
    {
        $url = static::JOB_LIST.'?'.http_build_query([
            'page' => $page,
            'limit' => $pageSize,
        ]);

        return $this->performRequest(JobListingResponse::class, $url);
    }

    /**
     * @template T
     *
     * @param class-string<T> $responseType
     *
     * @return T
     *
     * @throws TransportExceptionInterface
     */
    private function performRequest(string $responseType, string $url, string $method = 'GET')
    {
        $response = $this->recruitisClient->request($method, $url);
        $json = $response->getContent(false);

        return $this->serializer->deserialize($json, $responseType, 'json');
    }
}
