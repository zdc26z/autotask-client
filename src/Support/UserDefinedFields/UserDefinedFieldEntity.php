<?php

namespace Anteris\Autotask\Support\UserDefinedFields;

use Spatie\LaravelData\Data;

/**
 * Represents a user defined field from Autotask.
 * @see UserDefinedFieldCollection
 */
class UserDefinedFieldEntity extends Data
{
    public string $name;
    public ?string $value;
}
