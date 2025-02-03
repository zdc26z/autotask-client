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
                public ?int $dataType = null,
        public ?float $id = null,
        public ?string $name = null,
        public ?int $udfType = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?float $crmToProjectUdfId = null,
        public ?string $defaultValue = null,
        public ?string $description = null,
        public ?int $displayFormat = null,
        public ?bool $isActive = null,
        public ?bool $isEncrypted = null,
        public ?bool $isFieldMapping = null,
        public ?bool $isPrivate = null,
        public ?bool $isProtected = null,
        public ?bool $isRequired = null,
        public ?bool $isVisibleToClientPortal = null,
        public ?string $mergeVariableName = null,
        public ?int $numberOfDecimalPlaces = null,
        public ?int $sortOrder = null,
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
