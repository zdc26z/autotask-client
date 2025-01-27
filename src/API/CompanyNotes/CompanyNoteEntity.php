<?php

namespace Anteris\Autotask\API\CompanyNotes;

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
 * Represents CompanyNote entities.
 */
class CompanyNoteEntity extends Entity
{

    /**
     * Creates a new CompanyNote entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $actionType, 
                public int $assignedResourceID, 
                public int $companyID, 
        #[CastCarbon]
                public Carbon $completedDateTime = new Carbon(), 
                public int $contactID = '', 
        #[CastCarbon]
                public Carbon $createDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $endDateTime, 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
                public int $impersonatorUpdaterResourceID = '', 
        #[CastCarbon]
                public Carbon $lastModifiedDate = new Carbon(), 
                public string $name = '', 
                public string $note = '', 
                public int $opportunityID = '', 
        #[CastCarbon]
                public Carbon $startDateTime, 
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
