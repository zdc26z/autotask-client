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
        public ?int $companyID, 
public ?string $contractName, 
public ?int $contractType, 
#[CastCarbon]
        public ?Carbon $endDate, 
public ?float $id, 
#[CastCarbon]
        public ?Carbon $startDate, 
public ?int $status, 
public ?int $timeReportingRequiresStartAndStopTimes, 
public ?int $billingPreference, 
public ?int $billToCompanyContactID, 
public ?int $billToCompanyID, 
public ?int $contactID, 
public ?string $contactName, 
public ?int $contractCategory, 
public ?int $contractExclusionSetID, 
public ?string $contractNumber, 
public ?int $contractPeriodType, 
public ?string $description, 
public ?float $estimatedCost, 
public ?float $estimatedHours, 
public ?float $estimatedRevenue, 
public ?float $exclusionContractID, 
public ?float $internalCurrencyOverageBillingRate, 
public ?float $internalCurrencySetupFee, 
public ?bool $isCompliant, 
public ?bool $isDefaultContract, 
#[CastCarbon]
        public ?Carbon $lastModifiedDateTime, 
public ?int $opportunityID, 
public ?int $organizationalLevelAssociationID, 
public ?float $overageBillingRate, 
public ?string $purchaseOrderNumber, 
public ?float $renewedContractID, 
public ?int $serviceLevelAgreementID, 
public ?float $setupFee, 
public ?float $setupFeeBillingCodeID, 
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
