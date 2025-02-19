<?php

namespace Anteris\Autotask\API\BillingCodes;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents BillingCode entities.
 */
class BillingCodeEntity extends Entity
{

                /**
     * Creates a new BillingCode entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public float|array|null $id = null,
                        public ?bool $isActive = null,
                        public ?float $unitCost = null,
                        public ?float $unitPrice = null,
                        public ?int $afterHoursWorkType = null,
                        public ?int $billingCodeType = null,
                        public ?int $department = null,
                        public ?string $description = null,
                        public ?string $externalNumber = null,
                        public ?int $generalLedgerAccount = null,
                        public ?bool $isExcludedFromNewContracts = null,
                        public ?float $markupRate = null,
                        public ?string $name = null,
                        public ?int $taxCategoryID = null,
                        public ?int $useType = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($id)) {
            foreach($id as $prop => $value) {
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
