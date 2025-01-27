<?php

namespace Anteris\Autotask\API\UserDefinedFieldDefinitions;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Generator\Helpers\CastCarbon;
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
            #[CastCarbon]
                public Carbon $createDate = new Carbon(), 
                public int $crmToProjectUdfId = '', 
                public int $dataType, 
                public string $defaultValue = '', 
                public string $description = '', 
                public int $displayFormat = '', 
                public int $id, 
                public bool $isActive = false, 
                public bool $isEncrypted = false, 
                public bool $isFieldMapping = false, 
                public bool $isPrivate = false, 
                public bool $isProtected = false, 
                public bool $isRequired = false, 
                public bool $isVisibleToClientPortal = false, 
                public string $mergeVariableName = '', 
                public string $name, 
                public int $numberOfDecimalPlaces = '', 
                public int $sortOrder = '', 
                public int $udfType, 
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
