<?php

namespace Anteris\Autotask\API\NotificationHistory;

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
                    public int $companyID = '', 
                public string $entityNumber = '', 
                public string $entityTitle = '', 
                public int $id, 
                public int $initiatingContactID = '', 
                public int $initiatingResourceID = '', 
                public bool $isActive, 
                public bool $isDeleted, 
                public bool $isTemplateJob, 
                public int $notificationHistoryTypeID = '', 
        #[CastCarbon]
                public Carbon $notificationSentTime = new Carbon(), 
                public int $opportunityID = '', 
                public int $projectID = '', 
                public int $quoteID = '', 
                public string $recipientDisplayName = '', 
                public string $recipientEmailAddress = '', 
                public int $taskID = '', 
                public string $templateName = '', 
                public int $ticketID = '', 
                public int $timeEntryID = '', 
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
