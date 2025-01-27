<?php

namespace Anteris\Autotask\API\CompanyToDos;

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
 * Represents CompanyToDo entities.
 */
class CompanyToDoEntity extends Entity
{

    /**
     * Creates a new CompanyToDo entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $actionType, 
                public string $activityDescription = '', 
                public int $assignedToResourceID, 
                public int $companyID, 
        #[CastCarbon]
                public Carbon $completedDate = new Carbon(), 
                public int $contactID = '', 
                public int $contractID = '', 
        #[CastCarbon]
                public Carbon $createDateTime = new Carbon(), 
                public int $creatorResourceID = '', 
        #[CastCarbon]
                public Carbon $endDateTime, 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
        #[CastCarbon]
                public Carbon $lastModifiedDate = new Carbon(), 
                public int $opportunityID = '', 
        #[CastCarbon]
                public Carbon $startDateTime, 
                public int $ticketID = '', 
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
