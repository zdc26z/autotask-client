<?php

namespace Anteris\Autotask\API\TicketCategoryFieldDefaults;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents TicketCategoryFieldDefault entities.
 */
class TicketCategoryFieldDefaultEntity extends Entity
{

    /**
     * Creates a new TicketCategoryFieldDefault entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public string $description = '', 
                public float $estimatedHours = '', 
                public int $id, 
                public int $issueTypeID = '', 
                public int $organizationalLevelAssociationID = '', 
                public int $priority = '', 
                public string $purchaseOrderNumber = '', 
                public int $queueID = '', 
                public string $resolution = '', 
                public int $serviceLevelAgreementID = '', 
                public int $sourceID = '', 
                public int $status = '', 
                public int $subIssueTypeID = '', 
                public int $ticketCategoryID, 
                public int $ticketTypeID = '', 
                public string $title = '', 
                public int $workTypeID = '', 
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
