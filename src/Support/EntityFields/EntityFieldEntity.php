<?php

namespace Anteris\Autotask\Support\EntityFields;

use Spatie\LaravelData\Data;

/**
 * Represents an entity field response from Autotask.
 */
class EntityFieldEntity extends Data
{
    public string $name;
    public string $dataType;
    public int $length;
    public bool $isRequired;
    public bool $isReadOnly;
    public bool $isQueryable;
    public bool $isReference;
    public string $referenceEntityType;
    public bool $isPickList;
    public ?array $picklistValues;
    public ?string $picklistParentValueField;
    public bool $isSupportedWebhookField;
}
