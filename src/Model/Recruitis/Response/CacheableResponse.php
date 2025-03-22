<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Response;

abstract class CacheableResponse
{
    abstract public function isCacheable(): bool;
}
