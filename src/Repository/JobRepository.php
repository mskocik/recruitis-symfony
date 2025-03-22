<?php declare(strict_types=1);

namespace App\Repository;

use App\Model\Recruitis\Response\JobListingResponse;
use App\Service\Recruitis\ApiFetcher;
use Psr\Cache\CacheItemPoolInterface;

class JobRepository
{
    public function __construct(
        private ApiFetcher $recruitisApi,
        private CacheItemPoolInterface $cache 
    ) {}

    public function findAllOnPage(int $page = 1): JobListingResponse
    {
        return $this->recruitisApi->getJobs($page);
    }
}