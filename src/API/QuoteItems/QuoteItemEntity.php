<?php

namespace Anteris\Autotask\API\QuoteItems;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents QuoteItem entities.
 */
class QuoteItemEntity extends Entity
{

                /**
     * Creates a new QuoteItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public float|array|null $id = null,
                        public ?bool $isOptional = null,
                        public ?float $lineDiscount = null,
                        public ?float $percentageDiscount = null,
                        public ?float $quantity = null,
                        public ?int $quoteID = null,
                        public ?int $quoteItemType = null,
                        public ?float $unitDiscount = null,
                        public ?float $averageCost = null,
                        public ?int $chargeID = null,
                        public ?string $description = null,
                        public ?int $expenseID = null,
                        public ?float $highestCost = null,
                        public ?float $internalCurrencyLineDiscount = null,
                        public ?float $internalCurrencyUnitDiscount = null,
                        public ?float $internalCurrencyUnitPrice = null,
                        public ?bool $isTaxable = null,
                        public ?int $laborID = null,
                        public ?float $markupRate = null,
                        public ?string $name = null,
                        public ?int $periodType = null,
                        public ?int $productID = null,
                        public ?int $serviceBundleID = null,
                        public ?int $serviceID = null,
                        public ?int $shippingID = null,
                        public ?int $sortOrderID = null,
                        public ?int $taxCategoryID = null,
                        public ?float $totalEffectiveTax = null,
                        public ?float $unitCost = null,
                        public ?float $unitPrice = null,
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
