<?php

namespace Anteris\Autotask\API\Tickets;

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
 * Represents Ticket entities.
 */
class TicketEntity extends Entity
{

    /**
     * Creates a new Ticket entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $companyID = null,
        public ?float $id = null,
        public ?int $priority = null,
        public ?int $status = null,
        public ?string $title = null,
        public ?int $apiVendorID = null,
        public ?int $assignedResourceID = null,
        public ?int $assignedResourceRoleID = null,
        public ?int $billingCodeID = null,
        public ?int $changeApprovalBoard = null,
        public ?int $changeApprovalStatus = null,
        public ?int $changeApprovalType = null,
        public ?string $changeInfoField1 = null,
        public ?string $changeInfoField2 = null,
        public ?string $changeInfoField3 = null,
        public ?string $changeInfoField4 = null,
        public ?string $changeInfoField5 = null,
        public ?int $companyLocationID = null,
        public ?int $completedByResourceID = null,
        #[CastCarbon]
        public ?Carbon $completedDate = null,
        public ?int $configurationItemID = null,
        public ?int $contactID = null,
        public ?int $contractID = null,
        public ?float $contractServiceBundleID = null,
        public ?float $contractServiceID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $createdByContactID = null,
        public ?int $creatorResourceID = null,
        public ?int $creatorType = null,
        public ?int $currentServiceThermometerRating = null,
        public ?string $description = null,
        #[CastCarbon]
        public ?Carbon $dueDateTime = null,
        public ?float $estimatedHours = null,
        public ?string $externalID = null,
        public ?int $firstResponseAssignedResourceID = null,
        #[CastCarbon]
        public ?Carbon $firstResponseDateTime = null,
        #[CastCarbon]
        public ?Carbon $firstResponseDueDateTime = null,
        public ?int $firstResponseInitiatingResourceID = null,
        public ?float $hoursToBeScheduled = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?bool $isAssignedToComanaged = null,
        public ?int $issueType = null,
        public ?bool $isVisibleToComanaged = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDate = null,
        public ?int $lastActivityPersonType = null,
        public ?int $lastActivityResourceID = null,
        #[CastCarbon]
        public ?Carbon $lastCustomerNotificationDateTime = null,
        #[CastCarbon]
        public ?Carbon $lastCustomerVisibleActivityDateTime = null,
        #[CastCarbon]
        public ?Carbon $lastTrackedModificationDateTime = null,
        public ?float $monitorID = null,
        public ?int $monitorTypeID = null,
        public ?int $opportunityID = null,
        public ?int $organizationalLevelAssociationID = null,
        public ?int $previousServiceThermometerRating = null,
        public ?int $problemTicketId = null,
        public ?int $projectID = null,
        public ?string $purchaseOrderNumber = null,
        public ?int $queueID = null,
        public ?string $resolution = null,
        #[CastCarbon]
        public ?Carbon $resolutionPlanDateTime = null,
        #[CastCarbon]
        public ?Carbon $resolutionPlanDueDateTime = null,
        #[CastCarbon]
        public ?Carbon $resolvedDateTime = null,
        #[CastCarbon]
        public ?Carbon $resolvedDueDateTime = null,
        public ?int $rmaStatus = null,
        public ?int $rmaType = null,
        public ?string $rmmAlertID = null,
        public ?bool $serviceLevelAgreementHasBeenMet = null,
        public ?int $serviceLevelAgreementID = null,
        public ?float $serviceLevelAgreementPausedNextEventHours = null,
        public ?int $serviceThermometerTemperature = null,
        public ?int $source = null,
        public ?int $subIssueType = null,
        public ?int $ticketCategory = null,
        public ?string $ticketNumber = null,
        public ?int $ticketType = null,
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
