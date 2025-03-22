<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

use Symfony\Component\String\Slugger\AsciiSlugger;

class JobListingDetail
{
    public string $slug;

    /** @var EmploymentType[]|EmploymentType */
    public array|EmploymentType $employment;

    public function __construct(
        public int $jobId,
        public string $title,
    ) {
        $this->slug = strtolower((new AsciiSlugger())->slug($title)->toString());
    }
}
