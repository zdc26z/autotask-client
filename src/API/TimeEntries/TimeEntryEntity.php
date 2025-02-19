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
                        public float|array|null $id = null,
                        public ?int $resourceID = null,
                #[CastCarbon]
                public ?Carbon $billingApprovalDateTime = null,
                        public ?int $billingApprovalLevelMostRecent = null,
                        public ?int $billingApprovalResourceID = null,
                        public ?int $billingCodeID = null,
                        public ?int $contractID = null,
                        public ?float $contractServiceBundleID = null,
                        public ?float $contractServiceID = null,
                #[CastCarbon]
                public ?Carbon $createDateTime = null,
                        public ?int $creatorUserID = null,
                #[CastCarbon]
                public ?Carbon $dateWorked = null,
                #[CastCarbon]
                public ?Carbon $endDateTime = null,
                        public ?float $hoursToBill = null,
                        public ?float $hoursWorked = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?int $impersonatorUpdaterResourceID = null,
                        public ?int $internalBillingCodeID = null,
                        public ?string $internalNotes = null,
                        public ?bool $isInternalNotesVisibleToComanaged = null,
                        public ?bool $isNonBillable = null,
                #[CastCarbon]
                public ?Carbon $lastModifiedDateTime = null,
                        public ?int $lastModifiedUserID = null,
                        public ?float $offsetHours = null,
                        public ?int $roleID = null,
                        public ?bool $showOnInvoice = null,
                #[CastCarbon]
                public ?Carbon $startDateTime = null,
                        public ?string $summaryNotes = null,
                        public ?int $taskID = null,
                        public ?int $ticketID = null,
                        public ?int $timeEntryType = null,
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
