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
        public ?string $companyName, 
public mixed $companyType, 
public ?float $id, 
public ?int $ownerResourceID, 
public ?string $phone, 
public ?string $additionalAddressInformation, 
public ?string $address1, 
public ?string $address2, 
public ?string $alternatePhone1, 
public ?string $alternatePhone2, 
public ?int $apiVendorID, 
public ?float $assetValue, 
public ?string $billingAddress1, 
public ?string $billingAddress2, 
public ?string $billToAdditionalAddressInformation, 
public ?int $billToAddressToUse, 
public ?string $billToAttention, 
public ?string $billToCity, 
public ?int $billToCompanyLocationID, 
public ?int $billToCountryID, 
public ?string $billToState, 
public ?string $billToZipCode, 
public ?string $city, 
public ?int $classification, 
public ?int $companyCategoryID, 
public ?string $companyNumber, 
public ?int $competitorID, 
public ?int $countryID, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?int $createdByResourceID, 
public ?int $currencyID, 
public ?string $fax, 
public ?int $impersonatorCreatorResourceID, 
public ?int $invoiceEmailMessageID, 
public ?int $invoiceMethod, 
public ?bool $invoiceNonContractItemsToParentCompany, 
public ?int $invoiceTemplateID, 
public ?bool $isActive, 
public ?bool $isClientPortalActive, 
public ?bool $isEnabledForComanaged, 
public ?bool $isTaskFireActive, 
public ?bool $isTaxExempt, 
#[CastCarbon]
        public ?Carbon $lastActivityDate, 
#[CastCarbon]
        public ?Carbon $lastTrackedModifiedDateTime, 
public ?int $marketSegmentID, 
public ?int $parentCompanyID, 
public ?string $postalCode, 
public ?int $purchaseOrderTemplateID, 
public ?int $quoteEmailMessageID, 
public ?int $quoteTemplateID, 
public ?string $sicCode, 
public ?string $state, 
public ?string $stockMarket, 
public ?string $stockSymbol, 
public ?float $surveyCompanyRating, 
public ?string $taxID, 
public ?int $taxRegionID, 
public ?int $territoryID, 
public ?string $webAddress, 
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
