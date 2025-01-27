<?php

namespace Anteris\Autotask\API\Tickets;

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
                    public int $apiVendorID = '', 
                public int $assignedResourceID = '', 
                public int $assignedResourceRoleID = '', 
                public int $billingCodeID = '', 
                public int $changeApprovalBoard = '', 
                public int $changeApprovalStatus = '', 
                public int $changeApprovalType = '', 
                public string $changeInfoField1 = '', 
                public string $changeInfoField2 = '', 
                public string $changeInfoField3 = '', 
                public string $changeInfoField4 = '', 
                public string $changeInfoField5 = '', 
                public int $companyID, 
                public int $companyLocationID = '', 
                public int $completedByResourceID = '', 
        #[CastCarbon]
                public Carbon $completedDate = new Carbon(), 
                public int $configurationItemID = '', 
                public int $contactID = '', 
                public int $contractID = '', 
                public int $contractServiceBundleID = '', 
                public int $contractServiceID = '', 
        #[CastCarbon]
                public Carbon $createDate = new Carbon(), 
                public int $createdByContactID = '', 
                public int $creatorResourceID = '', 
                public int $creatorType = '', 
                public int $currentServiceThermometerRating = '', 
                public string $description = '', 
        #[CastCarbon]
                public Carbon $dueDateTime = new Carbon(), 
                public float $estimatedHours = '', 
                public string $externalID = '', 
                public int $firstResponseAssignedResourceID = '', 
        #[CastCarbon]
                public Carbon $firstResponseDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $firstResponseDueDateTime = new Carbon(), 
                public int $firstResponseInitiatingResourceID = '', 
                public float $hoursToBeScheduled = '', 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
                public bool $isAssignedToComanaged = false, 
                public int $issueType = '', 
                public bool $isVisibleToComanaged = false, 
        #[CastCarbon]
                public Carbon $lastActivityDate = new Carbon(), 
                public int $lastActivityPersonType = '', 
                public int $lastActivityResourceID = '', 
        #[CastCarbon]
                public Carbon $lastCustomerNotificationDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $lastCustomerVisibleActivityDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $lastTrackedModificationDateTime = new Carbon(), 
                public int $monitorID = '', 
                public int $monitorTypeID = '', 
                public int $opportunityID = '', 
                public int $organizationalLevelAssociationID = '', 
                public int $previousServiceThermometerRating = '', 
                public int $priority, 
                public int $problemTicketId = '', 
                public int $projectID = '', 
                public string $purchaseOrderNumber = '', 
                public int $queueID = '', 
                public string $resolution = '', 
        #[CastCarbon]
                public Carbon $resolutionPlanDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $resolutionPlanDueDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $resolvedDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $resolvedDueDateTime = new Carbon(), 
                public int $rmaStatus = '', 
                public int $rmaType = '', 
                public string $rmmAlertID = '', 
                public bool $serviceLevelAgreementHasBeenMet = false, 
                public int $serviceLevelAgreementID = '', 
                public float $serviceLevelAgreementPausedNextEventHours = '', 
                public int $serviceThermometerTemperature = '', 
                public int $source = '', 
                public int $status, 
                public int $subIssueType = '', 
                public int $ticketCategory = '', 
                public string $ticketNumber = '', 
                public int $ticketType = '', 
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
