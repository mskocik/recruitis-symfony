<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

class JobListingResponseMeta extends ResponseMeta
{
    public int $entries_from;

    public int $entries_to;

    public int $entries_total;

    public int $entries_sum;
}
