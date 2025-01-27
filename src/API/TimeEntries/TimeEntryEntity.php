<?php

namespace Anteris\Autotask\API\TimeEntries;

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
 * Represents TimeEntry entities.
 */
class TimeEntryEntity extends Entity
{

    /**
     * Creates a new TimeEntry entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
            #[CastCarbon]
                public Carbon $billingApprovalDateTime = new Carbon(), 
                public int $billingApprovalLevelMostRecent = '', 
                public int $billingApprovalResourceID = '', 
                public int $billingCodeID = '', 
                public int $contractID = '', 
                public int $contractServiceBundleID = '', 
                public int $contractServiceID = '', 
        #[CastCarbon]
                public Carbon $createDateTime = new Carbon(), 
                public int $creatorUserID = '', 
        #[CastCarbon]
                public Carbon $dateWorked = new Carbon(), 
        #[CastCarbon]
                public Carbon $endDateTime = new Carbon(), 
                public float $hoursToBill = '', 
                public float $hoursWorked = '', 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
                public int $impersonatorUpdaterResourceID = '', 
                public int $internalBillingCodeID = '', 
                public string $internalNotes = '', 
                public bool $isInternalNotesVisibleToComanaged = false, 
                public bool $isNonBillable = false, 
        #[CastCarbon]
                public Carbon $lastModifiedDateTime = new Carbon(), 
                public int $lastModifiedUserID = '', 
                public float $offsetHours = '', 
                public int $resourceID, 
                public int $roleID = '', 
                public bool $showOnInvoice = false, 
        #[CastCarbon]
                public Carbon $startDateTime = new Carbon(), 
                public string $summaryNotes = '', 
                public int $taskID = '', 
                public int $ticketID = '', 
                public int $timeEntryType = '', 
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
