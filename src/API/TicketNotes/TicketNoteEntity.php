<?php

namespace Anteris\Autotask\API\TicketNotes;

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
 * Represents TicketNote entities.
 */
class TicketNoteEntity extends Entity
{

    /**
     * Creates a new TicketNote entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?string $description = null,
        public ?float $id = null,
        public ?int $noteType = null,
        public ?int $publish = null,
        public ?int $ticketID = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?int $createdByContactID = null,
        public ?int $creatorResourceID = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?int $impersonatorUpdaterResourceID = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDate = null,
        public ?string $title = null,
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
