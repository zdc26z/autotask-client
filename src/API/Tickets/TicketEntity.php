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
        public ?int $companyID, 
public ?float $id, 
public ?int $priority, 
public ?int $status, 
public ?string $title, 
public ?int $apiVendorID, 
public ?int $assignedResourceID, 
public ?int $assignedResourceRoleID, 
public ?int $billingCodeID, 
public ?int $changeApprovalBoard, 
public ?int $changeApprovalStatus, 
public ?int $changeApprovalType, 
public ?string $changeInfoField1, 
public ?string $changeInfoField2, 
public ?string $changeInfoField3, 
public ?string $changeInfoField4, 
public ?string $changeInfoField5, 
public ?int $companyLocationID, 
public ?int $completedByResourceID, 
#[CastCarbon]
        public ?Carbon $completedDate, 
public ?int $configurationItemID, 
public ?int $contactID, 
public ?int $contractID, 
public ?float $contractServiceBundleID, 
public ?float $contractServiceID, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?int $createdByContactID, 
public ?int $creatorResourceID, 
public ?int $creatorType, 
public ?int $currentServiceThermometerRating, 
public ?string $description, 
#[CastCarbon]
        public ?Carbon $dueDateTime, 
public ?float $estimatedHours, 
public ?string $externalID, 
public ?int $firstResponseAssignedResourceID, 
#[CastCarbon]
        public ?Carbon $firstResponseDateTime, 
#[CastCarbon]
        public ?Carbon $firstResponseDueDateTime, 
public ?int $firstResponseInitiatingResourceID, 
public ?float $hoursToBeScheduled, 
public ?int $impersonatorCreatorResourceID, 
public ?bool $isAssignedToComanaged, 
public ?int $issueType, 
public ?bool $isVisibleToComanaged, 
#[CastCarbon]
        public ?Carbon $lastActivityDate, 
public ?int $lastActivityPersonType, 
public ?int $lastActivityResourceID, 
#[CastCarbon]
        public ?Carbon $lastCustomerNotificationDateTime, 
#[CastCarbon]
        public ?Carbon $lastCustomerVisibleActivityDateTime, 
#[CastCarbon]
        public ?Carbon $lastTrackedModificationDateTime, 
public ?float $monitorID, 
public ?int $monitorTypeID, 
public ?int $opportunityID, 
public ?int $organizationalLevelAssociationID, 
public ?int $previousServiceThermometerRating, 
public ?int $problemTicketId, 
public ?int $projectID, 
public ?string $purchaseOrderNumber, 
public ?int $queueID, 
public ?string $resolution, 
#[CastCarbon]
        public ?Carbon $resolutionPlanDateTime, 
#[CastCarbon]
        public ?Carbon $resolutionPlanDueDateTime, 
#[CastCarbon]
        public ?Carbon $resolvedDateTime, 
#[CastCarbon]
        public ?Carbon $resolvedDueDateTime, 
public ?int $rmaStatus, 
public ?int $rmaType, 
public ?string $rmmAlertID, 
public ?bool $serviceLevelAgreementHasBeenMet, 
public ?int $serviceLevelAgreementID, 
public ?float $serviceLevelAgreementPausedNextEventHours, 
public ?int $serviceThermometerTemperature, 
public ?int $source, 
public ?int $subIssueType, 
public ?int $ticketCategory, 
public ?string $ticketNumber, 
public ?int $ticketType, 
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
