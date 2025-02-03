<?php

namespace Anteris\Autotask\API\Companies;

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
 * Represents Company entities.
 */
class CompanyEntity extends Entity
{

    /**
     * Creates a new Company entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?string $companyName = null,
        public mixed $companyType = null,
        public ?float $id = null,
        public ?int $ownerResourceID = null,
        public ?string $phone = null,
        public ?string $additionalAddressInformation = null,
        public ?string $address1 = null,
        public ?string $address2 = null,
        public ?string $alternatePhone1 = null,
        public ?string $alternatePhone2 = null,
        public ?int $apiVendorID = null,
        public ?float $assetValue = null,
        public ?string $billingAddress1 = null,
        public ?string $billingAddress2 = null,
        public ?string $billToAdditionalAddressInformation = null,
        public ?int $billToAddressToUse = null,
        public ?string $billToAttention = null,
        public ?string $billToCity = null,
        public ?int $billToCompanyLocationID = null,
        public ?int $billToCountryID = null,
        public ?string $billToState = null,
        public ?string $billToZipCode = null,
        public ?string $city = null,
        public ?int $classification = null,
        public ?int $companyCategoryID = null,
        public ?string $companyNumber = null,
        public ?int $competitorID = null,
        public ?int $countryID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $createdByResourceID = null,
        public ?int $currencyID = null,
        public ?string $fax = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?int $invoiceEmailMessageID = null,
        public ?int $invoiceMethod = null,
        public ?bool $invoiceNonContractItemsToParentCompany = null,
        public ?int $invoiceTemplateID = null,
        public ?bool $isActive = null,
        public ?bool $isClientPortalActive = null,
        public ?bool $isEnabledForComanaged = null,
        public ?bool $isTaskFireActive = null,
        public ?bool $isTaxExempt = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDate = null,
        #[CastCarbon]
        public ?Carbon $lastTrackedModifiedDateTime = null,
        public ?int $marketSegmentID = null,
        public ?int $parentCompanyID = null,
        public ?string $postalCode = null,
        public ?int $purchaseOrderTemplateID = null,
        public ?int $quoteEmailMessageID = null,
        public ?int $quoteTemplateID = null,
        public ?string $sicCode = null,
        public ?string $state = null,
        public ?string $stockMarket = null,
        public ?string $stockSymbol = null,
        public ?float $surveyCompanyRating = null,
        public ?string $taxID = null,
        public ?int $taxRegionID = null,
        public ?int $territoryID = null,
        public ?string $webAddress = null,
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
