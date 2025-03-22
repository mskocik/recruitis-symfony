<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Response;

use App\Model\Recruitis\Entity\ResponseMeta;

class AnswerResponse
{
    public ?\stdClass $payload;

    public ResponseMeta $meta;
}
