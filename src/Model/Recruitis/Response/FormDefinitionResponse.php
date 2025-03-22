<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Response;

use App\Model\Recruitis\Entity\FormDefinitionPayload;

class FormDefinitionResponse extends CacheableResponse
{
    public ?FormDefinitionPayload $payload;

    public function isCacheable(): bool
    {
        return null !== $this->payload;
    }
}
