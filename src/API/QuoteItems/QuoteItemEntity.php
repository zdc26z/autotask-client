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
                    public float $averageCost = '', 
                public int $chargeID = '', 
                public string $description = '', 
                public int $expenseID = '', 
                public float $highestCost = '', 
                public int $id, 
                public float $internalCurrencyLineDiscount = '', 
                public float $internalCurrencyUnitDiscount = '', 
                public float $internalCurrencyUnitPrice = '', 
                public bool $isOptional, 
                public bool $isTaxable = false, 
                public int $laborID = '', 
                public float $lineDiscount, 
                public float $markupRate = '', 
                public string $name = '', 
                public float $percentageDiscount, 
                public int $periodType = '', 
                public int $productID = '', 
                public float $quantity, 
                public int $quoteID, 
                public int $quoteItemType, 
                public int $serviceBundleID = '', 
                public int $serviceID = '', 
                public int $shippingID = '', 
                public int $sortOrderID = '', 
                public int $taxCategoryID = '', 
                public float $totalEffectiveTax = '', 
                public float $unitCost = '', 
                public float $unitDiscount, 
                public float $unitPrice = '', 
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
