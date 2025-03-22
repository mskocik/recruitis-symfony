<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Response;

use App\Model\Recruitis\Entity\JobDetail;
use App\Model\Recruitis\Entity\ResponseMeta;

class JobDetailResponse
{
    public ResponseMeta $meta;

    public ?JobDetail $payload;
}
