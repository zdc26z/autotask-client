<?php

namespace Anteris\Autotask\API\Opportunities;

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
 * Represents Opportunity entities.
 */
class OpportunityEntity extends Entity
{

    /**
     * Creates a new Opportunity entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $amount = null,
        public ?int $companyID = null,
        public ?float $cost = null,
        public ?float $id = null,
        public ?int $ownerResourceID = null,
        public ?int $probability = null,
        #[CastCarbon]
        public ?Carbon $projectedCloseDate = null,
        public ?int $stage = null,
        #[CastCarbon]
        public ?Carbon $startDate = null,
        public ?int $status = null,
        public ?string $title = null,
        public ?bool $useQuoteTotals = null,
        public ?float $advancedField1 = null,
        public ?float $advancedField2 = null,
        public ?float $advancedField3 = null,
        public ?float $advancedField4 = null,
        public ?float $advancedField5 = null,
        public ?float $assessmentScore = null,
        public ?string $barriers = null,
        #[CastCarbon]
        public ?Carbon $closedDate = null,
        public ?int $contactID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $creatorResourceID = null,
        public ?string $description = null,
        public ?string $helpNeeded = null,
        public ?int $impersonatorCreatorResourceID = null,
        #[CastCarbon]
        public ?Carbon $lastActivity = null,
        public ?int $leadSource = null,
        public ?int $lossReason = null,
        public ?string $lossReasonDetail = null,
        #[CastCarbon]
        public ?Carbon $lostDate = null,
        public ?string $market = null,
        public ?float $monthlyCost = null,
        public ?float $monthlyRevenue = null,
        public ?string $nextStep = null,
        public ?float $onetimeCost = null,
        public ?float $onetimeRevenue = null,
        public ?int $opportunityCategoryID = null,
        public ?int $organizationalLevelAssociationID = null,
        public ?int $primaryCompetitor = null,
        public ?int $productID = null,
        #[CastCarbon]
        public ?Carbon $promisedFulfillmentDate = null,
        public ?string $promotionName = null,
        public ?float $quarterlyCost = null,
        public ?float $quarterlyRevenue = null,
        public ?int $rating = null,
        public ?float $relationshipAssessmentScore = null,
        public ?int $revenueSpread = null,
        public ?string $revenueSpreadUnit = null,
        public ?int $salesOrderID = null,
        public ?float $salesProcessPercentComplete = null,
        public ?float $semiannualCost = null,
        public ?float $semiannualRevenue = null,
        public ?float $technicalAssessmentScore = null,
        #[CastCarbon]
        public ?Carbon $throughDate = null,
        public ?int $totalAmountMonths = null,
        public ?int $winReason = null,
        public ?string $winReasonDetail = null,
        public ?float $yearlyCost = null,
        public ?float $yearlyRevenue = null,
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
