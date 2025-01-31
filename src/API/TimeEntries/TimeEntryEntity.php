<?php

namespace Anteris\Autotask\API\TimeEntries;

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
        public ?float $id, 
public ?int $resourceID, 
#[CastCarbon]
        public ?Carbon $billingApprovalDateTime, 
public ?int $billingApprovalLevelMostRecent, 
public ?int $billingApprovalResourceID, 
public ?int $billingCodeID, 
public ?int $contractID, 
public ?float $contractServiceBundleID, 
public ?float $contractServiceID, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $creatorUserID, 
#[CastCarbon]
        public ?Carbon $dateWorked, 
#[CastCarbon]
        public ?Carbon $endDateTime, 
public ?float $hoursToBill, 
public ?float $hoursWorked, 
public ?int $impersonatorCreatorResourceID, 
public ?int $impersonatorUpdaterResourceID, 
public ?int $internalBillingCodeID, 
public ?string $internalNotes, 
public ?bool $isInternalNotesVisibleToComanaged, 
public ?bool $isNonBillable, 
#[CastCarbon]
        public ?Carbon $lastModifiedDateTime, 
public ?int $lastModifiedUserID, 
public ?float $offsetHours, 
public ?int $roleID, 
public ?bool $showOnInvoice, 
#[CastCarbon]
        public ?Carbon $startDateTime, 
public ?string $summaryNotes, 
public ?int $taskID, 
public ?int $ticketID, 
public ?int $timeEntryType, 
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
