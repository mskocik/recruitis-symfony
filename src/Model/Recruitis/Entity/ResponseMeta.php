<?php declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

use App\Model\Recruitis\Enum\ResponseCode;


class ResponseMeta
{
    public ResponseCode $code;

    public string $message;
}
