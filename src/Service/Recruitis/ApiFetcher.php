<?php

declare(strict_types=1);

namespace App\Service\Recruitis;

use App\Model\Recruitis\Entity\JobDetail;
use App\Model\Recruitis\Enum\ResponseCode;
use App\Model\Recruitis\Response\JobDetailResponse;
use App\Model\Recruitis\Response\JobListingResponse;
use Psr\Cache\CacheItemPoolInterface;
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
        private CacheItemPoolInterface $cache,
    ) {
    }

    public function getJobPage(int $page, int $pageSize = 10): JobListingResponse
    {
        $url = static::JOB_LIST.'?'.http_build_query([
            'page' => $page,
            'limit' => $pageSize,
        ]);

        return $this->performRequest(JobListingResponse::class, $url, cacheKey: "page_$page");
    }

    public function getJobById(int $jobId): ?JobDetail
    {
        $url = sprintf(static::JOB_DETAIL, $jobId);
        $response = $this->performRequest(JobDetailResponse::class, $url, cacheKey: "job_$jobId");

        return $response->payload;
    }



    /**
     * @template T
     *
     * @param class-string<T> $responseType
     *
     * @return T
     */
    private function performRequest(string $responseType, string $url, string $cacheKey, string $method = 'GET')
    {
        try {
            $cachedItem = $this->cache->getItem($cacheKey);
            if ($cachedItem->isHit()) {
                return $cachedItem->get();
            }

            $response = $this->recruitisClient->request($method, $url);
            $json = $response->getContent(false);

            $responseObject = $this->serializer->deserialize($json, $responseType, 'json');

            $cachedItem->expiresAfter(10);
            $this->cache->save($cachedItem->set($responseObject));

            return $responseObject;
        } catch (TransportExceptionInterface $ex) {
            $code = ResponseCode::API_UNAVAILABLE->value;
            $message = $ex->getMessage();
            $json = <<<JSON
            {
                "payload": null,
                "meta": {
                    "code": "$code",
                    "message": "$message"
                }
            }
            JSON;

            return $this->serializer->deserialize($json, $responseType, 'json');
        }
    }
}
