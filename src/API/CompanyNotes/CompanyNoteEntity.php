<?php

namespace Anteris\Autotask\API\CompanyNotes;

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
        public ?int $actionType, 
public ?int $assignedResourceID, 
public ?int $companyID, 
#[CastCarbon]
        public ?Carbon $endDateTime, 
public ?float $id, 
#[CastCarbon]
        public ?Carbon $startDateTime, 
#[CastCarbon]
        public ?Carbon $completedDateTime, 
public ?int $contactID, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $impersonatorCreatorResourceID, 
public ?int $impersonatorUpdaterResourceID, 
#[CastCarbon]
        public ?Carbon $lastModifiedDate, 
public ?string $name, 
public ?string $note, 
public ?int $opportunityID, 
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
