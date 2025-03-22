<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

class FormField
{
    public string $name;

    public string $type;

    public string $label;

    public string|int|array|null $value;

    public bool $required;

    public ?array $options;

    public bool $hidden;

    public int $order;
}
