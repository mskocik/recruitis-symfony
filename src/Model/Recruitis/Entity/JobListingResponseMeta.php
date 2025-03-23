<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

class JobListingResponseMeta extends ResponseMeta
{
    public int $entriesFrom;

    public int $entriesTo;

    public int $entriesTotal;

    public int $entriesSum;
}
