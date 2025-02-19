<?php

namespace Anteris\Autotask\API\Projects;

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
                        public int|array|null $companyID = null,
                #[CastCarbon]
                public ?Carbon $endDateTime = null,
                        public ?float $id = null,
                        public ?string $projectName = null,
                        public ?int $projectType = null,
                #[CastCarbon]
                public ?Carbon $startDateTime = null,
                        public ?int $status = null,
                        public ?float $actualBilledHours = null,
                        public ?float $actualHours = null,
                        public ?float $changeOrdersBudget = null,
                        public ?float $changeOrdersRevenue = null,
                        public ?int $companyOwnerResourceID = null,
                #[CastCarbon]
                public ?Carbon $completedDateTime = null,
                        public ?int $completedPercentage = null,
                        public ?int $contractID = null,
                #[CastCarbon]
                public ?Carbon $createDateTime = null,
                        public ?int $creatorResourceID = null,
                        public ?int $department = null,
                        public ?string $description = null,
                        public ?int $duration = null,
                        public ?float $estimatedSalesCost = null,
                        public ?float $estimatedTime = null,
                        public ?string $extProjectNumber = null,
                        public ?int $extProjectType = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?float $laborEstimatedCosts = null,
                        public ?float $laborEstimatedMarginPercentage = null,
                        public ?float $laborEstimatedRevenue = null,
                #[CastCarbon]
                public ?Carbon $lastActivityDateTime = null,
                        public ?int $lastActivityPersonType = null,
                        public ?int $lastActivityResourceID = null,
                        public ?int $opportunityID = null,
                        public ?int $organizationalLevelAssociationID = null,
                        public ?float $originalEstimatedRevenue = null,
                        public ?float $projectCostEstimatedMarginPercentage = null,
                        public ?float $projectCostsBudget = null,
                        public ?float $projectCostsRevenue = null,
                        public ?int $projectLeadResourceID = null,
                        public ?string $projectNumber = null,
                        public ?string $purchaseOrderNumber = null,
                        public ?float $sgda = null,
                #[CastCarbon]
                public ?Carbon $statusDateTime = null,
                        public ?string $statusDetail = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($companyID)) {
            foreach($companyID as $prop => $value) {
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
