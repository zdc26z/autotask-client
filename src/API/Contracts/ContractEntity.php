<?php

namespace Anteris\Autotask\API\Contracts;

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
                        public int|array|null $companyID = null,
                        public ?string $contractName = null,
                        public ?int $contractType = null,
                #[CastCarbon]
                public ?Carbon $endDate = null,
                        public ?float $id = null,
                #[CastCarbon]
                public ?Carbon $startDate = null,
                        public ?int $status = null,
                        public ?int $timeReportingRequiresStartAndStopTimes = null,
                        public ?int $billingPreference = null,
                        public ?int $billToCompanyContactID = null,
                        public ?int $billToCompanyID = null,
                        public ?int $contactID = null,
                        public ?string $contactName = null,
                        public ?int $contractCategory = null,
                        public ?int $contractExclusionSetID = null,
                        public ?string $contractNumber = null,
                        public ?int $contractPeriodType = null,
                        public ?string $description = null,
                        public ?float $estimatedCost = null,
                        public ?float $estimatedHours = null,
                        public ?float $estimatedRevenue = null,
                        public ?float $exclusionContractID = null,
                        public ?float $internalCurrencyOverageBillingRate = null,
                        public ?float $internalCurrencySetupFee = null,
                        public ?bool $isCompliant = null,
                        public ?bool $isDefaultContract = null,
                #[CastCarbon]
                public ?Carbon $lastModifiedDateTime = null,
                        public ?int $opportunityID = null,
                        public ?int $organizationalLevelAssociationID = null,
                        public ?float $overageBillingRate = null,
                        public ?string $purchaseOrderNumber = null,
                        public ?float $renewedContractID = null,
                        public ?int $serviceLevelAgreementID = null,
                        public ?float $setupFee = null,
                        public ?float $setupFeeBillingCodeID = null,
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
