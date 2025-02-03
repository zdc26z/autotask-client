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
                public ?string $currencyNegativeFormat = null,
        public ?string $currencyPositiveFormat = null,
        public ?int $dateFormat = null,
        public ?bool $displayFixedPriceContractLabor = null,
        public ?bool $displayRecurringServiceContractLabor = null,
        public ?bool $displaySeparateLineItemForEachTax = null,
        public ?bool $displayTaxCategory = null,
        public ?bool $displayTaxCategorySuperscripts = null,
        public ?bool $displayZeroAmountRecurringServicesAndBundles = null,
        public ?int $groupBy = null,
        public ?float $id = null,
        public ?int $itemizeItemsInEachGroup = null,
        public ?bool $itemizeServicesAndBundles = null,
        public ?string $name = null,
        public ?int $numberFormat = null,
        public ?int $pageLayout = null,
        public ?int $pageNumberFormat = null,
        public ?bool $showGridHeader = null,
        public ?bool $showVerticalGridLines = null,
        public ?int $sortBy = null,
        public ?int $timeFormat = null,
        public ?string $coveredByBlockRetainerContractLabel = null,
        public ?string $coveredByRecurringServiceFixedPricePerTicketContractLabel = null,
        public ?string $nonBillableLaborLabel = null,
        public ?int $paymentTerms = null,
        public ?string $rateCostExpression = null,
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
