<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

use Symfony\Component\String\Slugger\AsciiSlugger;

class JobListingDetail
{
    public string $slug;

    public function __construct(
        public int $jobId,
        public string $title,
        // public string $description
    ) {
        $this->slug = (new AsciiSlugger())->slug($title)->toString();
    }
}
