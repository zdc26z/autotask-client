<?php

namespace Anteris\Autotask\API\Tasks;

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
 * Represents Task entities.
 */
class TaskEntity extends Entity
{

    /**
     * Creates a new Task entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $id = null,
        public ?int $projectID = null,
        public ?int $status = null,
        public ?int $taskType = null,
        public ?string $title = null,
        public ?int $assignedResourceID = null,
        public ?int $assignedResourceRoleID = null,
        public ?int $billingCodeID = null,
        public ?bool $canClientPortalUserCompleteTask = null,
        public ?int $companyLocationID = null,
        public ?int $completedByResourceID = null,
        public ?int $completedByType = null,
        #[CastCarbon]
        public ?Carbon $completedDateTime = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?int $creatorResourceID = null,
        public ?int $creatorType = null,
        public ?int $departmentID = null,
        public ?string $description = null,
        #[CastCarbon]
        public ?Carbon $endDateTime = null,
        public ?float $estimatedHours = null,
        public ?string $externalID = null,
        public ?float $hoursToBeScheduled = null,
        public ?bool $isTaskBillable = null,
        public ?bool $isVisibleInClientPortal = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDateTime = null,
        public ?int $lastActivityPersonType = null,
        public ?int $lastActivityResourceID = null,
        public ?int $phaseID = null,
        public ?int $priority = null,
        public ?int $priorityLabel = null,
        public ?string $purchaseOrderNumber = null,
        public ?float $remainingHours = null,
        #[CastCarbon]
        public ?Carbon $startDateTime = null,
        public ?int $taskCategoryID = null,
        public ?string $taskNumber = null,
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
