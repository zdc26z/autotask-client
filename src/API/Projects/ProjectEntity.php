<?php

namespace Anteris\Autotask\API\Projects;

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
 * Represents Project entities.
 */
class ProjectEntity extends Entity
{

    /**
     * Creates a new Project entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public float $actualBilledHours = '', 
                public float $actualHours = '', 
                public float $changeOrdersBudget = '', 
                public float $changeOrdersRevenue = '', 
                public int $companyID, 
                public int $companyOwnerResourceID = '', 
        #[CastCarbon]
                public Carbon $completedDateTime = new Carbon(), 
                public int $completedPercentage = '', 
                public int $contractID = '', 
        #[CastCarbon]
                public Carbon $createDateTime = new Carbon(), 
                public int $creatorResourceID = '', 
                public int $department = '', 
                public string $description = '', 
                public int $duration = '', 
        #[CastCarbon]
                public Carbon $endDateTime, 
                public float $estimatedSalesCost = '', 
                public float $estimatedTime = '', 
                public string $extProjectNumber = '', 
                public int $extProjectType = '', 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
                public float $laborEstimatedCosts = '', 
                public float $laborEstimatedMarginPercentage = '', 
                public float $laborEstimatedRevenue = '', 
        #[CastCarbon]
                public Carbon $lastActivityDateTime = new Carbon(), 
                public int $lastActivityPersonType = '', 
                public int $lastActivityResourceID = '', 
                public int $opportunityID = '', 
                public int $organizationalLevelAssociationID = '', 
                public float $originalEstimatedRevenue = '', 
                public float $projectCostEstimatedMarginPercentage = '', 
                public float $projectCostsBudget = '', 
                public float $projectCostsRevenue = '', 
                public int $projectLeadResourceID = '', 
                public string $projectName, 
                public string $projectNumber = '', 
                public int $projectType, 
                public string $purchaseOrderNumber = '', 
                public float $sgda = '', 
        #[CastCarbon]
                public Carbon $startDateTime, 
                public int $status, 
        #[CastCarbon]
                public Carbon $statusDateTime = new Carbon(), 
                public string $statusDetail = '', 
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
