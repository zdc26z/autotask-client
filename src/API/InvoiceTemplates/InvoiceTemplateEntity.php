<?php

namespace Anteris\Autotask\API\InvoiceTemplates;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents InvoiceTemplate entities.
 */
class InvoiceTemplateEntity extends Entity
{

    /**
     * Creates a new InvoiceTemplate entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public string $coveredByBlockRetainerContractLabel = '', 
                public string $coveredByRecurringServiceFixedPricePerTicketContractLabel = '', 
                public string $currencyNegativeFormat, 
                public string $currencyPositiveFormat, 
                public int $dateFormat, 
                public bool $displayFixedPriceContractLabor, 
                public bool $displayRecurringServiceContractLabor, 
                public bool $displaySeparateLineItemForEachTax, 
                public bool $displayTaxCategory, 
                public bool $displayTaxCategorySuperscripts, 
                public bool $displayZeroAmountRecurringServicesAndBundles, 
                public int $groupBy, 
                public int $id, 
                public int $itemizeItemsInEachGroup, 
                public bool $itemizeServicesAndBundles, 
                public string $name, 
                public string $nonBillableLaborLabel = '', 
                public int $numberFormat, 
                public int $pageLayout, 
                public int $pageNumberFormat, 
                public int $paymentTerms = '', 
                public string $rateCostExpression = '', 
                public bool $showGridHeader, 
                public bool $showVerticalGridLines, 
                public int $sortBy, 
                public int $timeFormat, 
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
