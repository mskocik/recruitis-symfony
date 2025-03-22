<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

class JobDetail
{
    public int $jobId;

    public string $title;

    public string $description;

    /** @var EmploymentType[]|EmploymentType */
    public array|EmploymentType $employment;
}
