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
        public ?float $id, 
public ?bool $isActive, 
public ?bool $isDeleted, 
public ?bool $isTemplateJob, 
public ?float $companyID, 
public ?string $entityNumber, 
public ?string $entityTitle, 
public ?float $initiatingContactID, 
public ?float $initiatingResourceID, 
public ?int $notificationHistoryTypeID, 
#[CastCarbon]
        public ?Carbon $notificationSentTime, 
public ?float $opportunityID, 
public ?float $projectID, 
public ?float $quoteID, 
public ?string $recipientDisplayName, 
public ?string $recipientEmailAddress, 
public ?float $taskID, 
public ?string $templateName, 
public ?float $ticketID, 
public ?float $timeEntryID, 
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
