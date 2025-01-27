<?php

namespace Anteris\Autotask\API\Tasks;

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
                    public int $assignedResourceID = '', 
                public int $assignedResourceRoleID = '', 
                public int $billingCodeID = '', 
                public bool $canClientPortalUserCompleteTask = false, 
                public int $companyLocationID = '', 
                public int $completedByResourceID = '', 
                public int $completedByType = '', 
        #[CastCarbon]
                public Carbon $completedDateTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $createDateTime = new Carbon(), 
                public int $creatorResourceID = '', 
                public int $creatorType = '', 
                public int $departmentID = '', 
                public string $description = '', 
        #[CastCarbon]
                public Carbon $endDateTime = new Carbon(), 
                public float $estimatedHours = '', 
                public string $externalID = '', 
                public float $hoursToBeScheduled = '', 
                public int $id, 
                public bool $isTaskBillable = false, 
                public bool $isVisibleInClientPortal = false, 
        #[CastCarbon]
                public Carbon $lastActivityDateTime = new Carbon(), 
                public int $lastActivityPersonType = '', 
                public int $lastActivityResourceID = '', 
                public int $phaseID = '', 
                public int $priority = '', 
                public int $priorityLabel = '', 
                public int $projectID, 
                public string $purchaseOrderNumber = '', 
                public float $remainingHours = '', 
        #[CastCarbon]
                public Carbon $startDateTime = new Carbon(), 
                public int $status, 
                public int $taskCategoryID = '', 
                public string $taskNumber = '', 
                public int $taskType, 
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
