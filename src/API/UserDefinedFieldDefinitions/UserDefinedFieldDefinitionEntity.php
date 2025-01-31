<?php

namespace Anteris\Autotask\API\UserDefinedFieldDefinitions;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\CastCarbon;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use Carbon\Carbon;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents UserDefinedFieldDefinition entities.
 */
class UserDefinedFieldDefinitionEntity extends Entity
{

    /**
     * Creates a new UserDefinedFieldDefinition entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $dataType, 
public ?float $id, 
public ?string $name, 
public ?int $udfType, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?float $crmToProjectUdfId, 
public ?string $defaultValue, 
public ?string $description, 
public ?int $displayFormat, 
public ?bool $isActive, 
public ?bool $isEncrypted, 
public ?bool $isFieldMapping, 
public ?bool $isPrivate, 
public ?bool $isProtected, 
public ?bool $isRequired, 
public ?bool $isVisibleToClientPortal, 
public ?string $mergeVariableName, 
public ?int $numberOfDecimalPlaces, 
public ?int $sortOrder, 
        #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
    }

    /**
     * Creates an instance of this class from an Http response.
     *
     * @param  Response  $response  Http response.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public static function fromResponse(Response $response)
    {
        $responseArray = json_decode($response->getBody(), true);

        if (isset($responseArray['item']) === false) {
            throw new \Exception('Missing item key in response.');
        }

        $mapper = new ObjectMapperUsingReflection(
            new DefinitionProvider(
                keyFormatter: new KeyFormatterWithoutConversion(),
            ),
        );
        return $mapper->hydrateObject(self::class, $responseArray['item']);
    }
}
