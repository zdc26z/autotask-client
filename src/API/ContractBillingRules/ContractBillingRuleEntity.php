<?php

namespace Anteris\Autotask\API\ContractBillingRules;

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
 * Represents ContractBillingRule entities.
 */
class ContractBillingRuleEntity extends Entity
{

                /**
     * Creates a new ContractBillingRule entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public int|array|null $contractID = null,
                        public ?bool $createChargesAsBillable = null,
                        public ?int $determineUnits = null,
                        public ?float $id = null,
                        public ?bool $includeItemsInChargeDescription = null,
                        public ?bool $isActive = null,
                        public ?bool $isDailyProrationEnabled = null,
                        public ?int $productID = null,
                #[CastCarbon]
                public ?Carbon $startDate = null,
                        public ?float $dailyProratedCost = null,
                        public ?float $dailyProratedPrice = null,
                #[CastCarbon]
                public ?Carbon $endDate = null,
                        public ?int $executionMethod = null,
                        public ?string $invoiceDescription = null,
                        public ?int $maximumUnits = null,
                        public ?int $minimumUnits = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($contractID)) {
            foreach($contractID as $prop => $value) {
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
