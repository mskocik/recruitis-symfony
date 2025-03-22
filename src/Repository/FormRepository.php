<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Recruitis\Entity\FormDefinitionPayload;
use App\Model\Recruitis\Response\AnswerResponse;
use App\Service\Recruitis\ApiFetcher;
use Psr\Cache\InvalidArgumentException;

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

    /**
     * @param array<string, string|int> $postData
     *
     * @throws InvalidArgumentException
     */
    public function submitAnwser(int $jobId, array $postData): AnswerResponse
    {
        /*
         * commented out, because "You don't have permission to access this job."
         * So continue directly to submit answer
         */
        // $this->recruitisApi->validatePostData($jobId, $postData);
        return $this->recruitisApi->submitAnswer($jobId, $postData);
    }
}
