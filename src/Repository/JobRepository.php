<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Recruitis\Response\JobListingResponse;
use App\Service\Recruitis\ApiFetcher;

class JobRepository
{
    public function __construct(
        private ApiFetcher $recruitisApi,
    ) {
    }

    public function findAllOnPage(int $page = 1): JobListingResponse
    {
        return $this->recruitisApi->getJobs($page);
    }
}
