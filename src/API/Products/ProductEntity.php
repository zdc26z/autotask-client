<?php

namespace Anteris\Autotask\API\Products;

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
 * Represents Product entities.
 */
class ProductEntity extends Entity
{

    /**
     * Creates a new Product entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?float $id, 
public ?bool $isActive, 
public ?bool $isSerialized, 
public ?string $name, 
public ?int $productBillingCodeID, 
public ?int $billingType, 
public ?int $chargeBillingCodeID, 
public ?int $createdByResourceID, 
#[CastCarbon]
        public ?Carbon $createdTime, 
public ?int $defaultInstalledProductCategoryID, 
public ?int $defaultVendorID, 
public ?string $description, 
public ?bool $doesNotRequireProcurement, 
public ?string $externalProductID, 
public ?int $impersonatorCreatorResourceID, 
public ?string $internalProductID, 
public ?bool $isEligibleForRma, 
public ?string $link, 
public ?string $manufacturerName, 
public ?string $manufacturerProductName, 
public ?float $markupRate, 
public ?float $msrp, 
public ?int $periodType, 
public ?int $priceCostMethod, 
public ?int $productCategory, 
public ?string $sku, 
public ?float $unitCost, 
public ?float $unitPrice, 
public ?string $vendorProductNumber, 
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
