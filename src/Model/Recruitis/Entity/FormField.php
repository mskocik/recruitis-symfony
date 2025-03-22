<?php

declare(strict_types=1);

namespace App\Model\Recruitis\Entity;

class FormField
{
    public string $name;

    public string $type;

    public string $label;

    /** @var string|int|array<string>|null */
    public string|int|array|null $value;

    public bool $required;

    /** @var array<string, string|int> */
    public ?array $options;

    public bool $hidden;

    public int $order;
}
