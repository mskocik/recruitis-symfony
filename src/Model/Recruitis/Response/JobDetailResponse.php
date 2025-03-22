<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Response;

use App\Model\Recruitis\Entity\JobDetail;
use App\Model\Recruitis\Entity\ResponseMeta;

class JobDetailResponse extends CacheableResponse
{
    public ResponseMeta $meta;

    public ?JobDetail $payload;

    public function isCacheable(): bool
    {
        return null !== $this->payload;
    }

    public function getCacheablePart(): mixed
    {
        return $this->payload;
    }
}
