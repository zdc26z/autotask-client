<?php

namespace Anteris\Autotask\API\TicketNoteAttachments;

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
 * Represents TicketNoteAttachment entities.
 */
class TicketNoteAttachmentEntity extends Entity
{

    /**
     * Creates a new TicketNoteAttachment entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
            #[CastCarbon]
                public Carbon $attachDate = new Carbon(), 
                public int $attachedByContactID = '', 
                public int $attachedByResourceID = '', 
                public string $attachmentType, 
                public string $contentType = '', 
                public int $creatorType = '', 
                public  $data = '', 
                public int $fileSize = '', 
                public string $fullPath, 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
                public int $opportunityID = '', 
                public int $parentID = '', 
                public int $publish, 
                public int $ticketID = '', 
                public int $ticketNoteID = '', 
                public string $title, 
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
