<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Response;

use App\Model\Recruitis\Entity\JobListingDetail;
use App\Model\Recruitis\Entity\JobListingResponseMeta;

class JobListingResponse extends CacheableResponse
{
    /** @var JobListingDetail[]|null */
    public ?array $payload;

    public JobListingResponseMeta $meta;

    public function isCacheable(): bool
    {
        return null !== $this->payload;
    }
}
