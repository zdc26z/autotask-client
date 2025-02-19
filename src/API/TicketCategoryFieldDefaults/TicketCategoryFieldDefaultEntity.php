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
                        public float|array|null $id = null,
                        public ?int $ticketCategoryID = null,
                        public ?string $description = null,
                        public ?float $estimatedHours = null,
                        public ?int $issueTypeID = null,
                        public ?int $organizationalLevelAssociationID = null,
                        public ?int $priority = null,
                        public ?string $purchaseOrderNumber = null,
                        public ?int $queueID = null,
                        public ?string $resolution = null,
                        public ?int $serviceLevelAgreementID = null,
                        public ?int $sourceID = null,
                        public ?int $status = null,
                        public ?int $subIssueTypeID = null,
                        public ?int $ticketTypeID = null,
                        public ?string $title = null,
                        public ?int $workTypeID = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($id)) {
            foreach($id as $prop => $value) {
                if(property_exists($this, $prop)) {
                    $this->$prop = $value;
                }
            }
        }
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
