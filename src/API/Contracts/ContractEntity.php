<?php

namespace Anteris\Autotask\API\Contracts;

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
 * Represents Contract entities.
 */
class ContractEntity extends Entity
{

    /**
     * Creates a new Contract entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $billingPreference = '', 
                public int $billToCompanyContactID = '', 
                public int $billToCompanyID = '', 
                public int $companyID, 
                public int $contactID = '', 
                public string $contactName = '', 
                public int $contractCategory = '', 
                public int $contractExclusionSetID = '', 
                public string $contractName, 
                public string $contractNumber = '', 
                public int $contractPeriodType = '', 
                public int $contractType, 
                public string $description = '', 
        #[CastCarbon]
                public Carbon $endDate, 
                public float $estimatedCost = '', 
                public float $estimatedHours = '', 
                public float $estimatedRevenue = '', 
                public int $exclusionContractID = '', 
                public int $id, 
                public float $internalCurrencyOverageBillingRate = '', 
                public float $internalCurrencySetupFee = '', 
                public bool $isCompliant = false, 
                public bool $isDefaultContract = false, 
        #[CastCarbon]
                public Carbon $lastModifiedDateTime = new Carbon(), 
                public int $opportunityID = '', 
                public int $organizationalLevelAssociationID = '', 
                public float $overageBillingRate = '', 
                public string $purchaseOrderNumber = '', 
                public int $renewedContractID = '', 
                public int $serviceLevelAgreementID = '', 
                public float $setupFee = '', 
                public int $setupFeeBillingCodeID = '', 
        #[CastCarbon]
                public Carbon $startDate, 
                public int $status, 
                public int $timeReportingRequiresStartAndStopTimes, 
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
