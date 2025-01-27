<?php

namespace Anteris\Autotask\API\Opportunities;

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
                    public float $advancedField1 = '', 
                public float $advancedField2 = '', 
                public float $advancedField3 = '', 
                public float $advancedField4 = '', 
                public float $advancedField5 = '', 
                public float $amount, 
                public float $assessmentScore = '', 
                public string $barriers = '', 
        #[CastCarbon]
                public Carbon $closedDate = new Carbon(), 
                public int $companyID, 
                public int $contactID = '', 
                public float $cost, 
        #[CastCarbon]
                public Carbon $createDate = new Carbon(), 
                public int $creatorResourceID = '', 
                public string $description = '', 
                public string $helpNeeded = '', 
                public int $id, 
                public int $impersonatorCreatorResourceID = '', 
        #[CastCarbon]
                public Carbon $lastActivity = new Carbon(), 
                public int $leadSource = '', 
                public int $lossReason = '', 
                public string $lossReasonDetail = '', 
        #[CastCarbon]
                public Carbon $lostDate = new Carbon(), 
                public string $market = '', 
                public float $monthlyCost = '', 
                public float $monthlyRevenue = '', 
                public string $nextStep = '', 
                public float $onetimeCost = '', 
                public float $onetimeRevenue = '', 
                public int $opportunityCategoryID = '', 
                public int $organizationalLevelAssociationID = '', 
                public int $ownerResourceID, 
                public int $primaryCompetitor = '', 
                public int $probability, 
                public int $productID = '', 
        #[CastCarbon]
                public Carbon $projectedCloseDate, 
        #[CastCarbon]
                public Carbon $promisedFulfillmentDate = new Carbon(), 
                public string $promotionName = '', 
                public float $quarterlyCost = '', 
                public float $quarterlyRevenue = '', 
                public int $rating = '', 
                public float $relationshipAssessmentScore = '', 
                public int $revenueSpread = '', 
                public string $revenueSpreadUnit = '', 
                public int $salesOrderID = '', 
                public float $salesProcessPercentComplete = '', 
                public float $semiannualCost = '', 
                public float $semiannualRevenue = '', 
                public int $stage, 
        #[CastCarbon]
                public Carbon $startDate, 
                public int $status, 
                public float $technicalAssessmentScore = '', 
        #[CastCarbon]
                public Carbon $throughDate = new Carbon(), 
                public string $title, 
                public int $totalAmountMonths = '', 
                public bool $useQuoteTotals, 
                public int $winReason = '', 
                public string $winReasonDetail = '', 
                public float $yearlyCost = '', 
                public float $yearlyRevenue = '', 
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
