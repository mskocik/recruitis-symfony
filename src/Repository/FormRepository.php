<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Recruitis\Entity\FormDefinitionPayload;
use App\Service\Recruitis\ApiFetcher;

class FormRepository
{
    public function __construct(
        private ApiFetcher $recruitisApi,
    ) {
    }

    public function getDefinitonByJob(int $jobId): ?FormDefinitionPayload
    {
        $definition = $this->recruitisApi->getJobFormDefinition($jobId);

        return $definition;
    }
}
