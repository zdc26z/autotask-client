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
                public ?int $actionType = null,
        public ?int $assignedResourceID = null,
        public ?int $companyID = null,
        #[CastCarbon]
        public ?Carbon $endDateTime = null,
        public ?float $id = null,
        #[CastCarbon]
        public ?Carbon $startDateTime = null,
        #[CastCarbon]
        public ?Carbon $completedDateTime = null,
        public ?int $contactID = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?int $impersonatorUpdaterResourceID = null,
        #[CastCarbon]
        public ?Carbon $lastModifiedDate = null,
        public ?string $name = null,
        public ?string $note = null,
        public ?int $opportunityID = null,
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
