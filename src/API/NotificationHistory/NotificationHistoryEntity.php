<?php

namespace Anteris\Autotask\API\NotificationHistory;

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
 * Represents NotificationHistory entities.
 */
class NotificationHistoryEntity extends Entity
{

    /**
     * Creates a new NotificationHistory entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $id = null,
        public ?bool $isActive = null,
        public ?bool $isDeleted = null,
        public ?bool $isTemplateJob = null,
        public ?float $companyID = null,
        public ?string $entityNumber = null,
        public ?string $entityTitle = null,
        public ?float $initiatingContactID = null,
        public ?float $initiatingResourceID = null,
        public ?int $notificationHistoryTypeID = null,
        #[CastCarbon]
        public ?Carbon $notificationSentTime = null,
        public ?float $opportunityID = null,
        public ?float $projectID = null,
        public ?float $quoteID = null,
        public ?string $recipientDisplayName = null,
        public ?string $recipientEmailAddress = null,
        public ?float $taskID = null,
        public ?string $templateName = null,
        public ?float $ticketID = null,
        public ?float $timeEntryID = null,
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
