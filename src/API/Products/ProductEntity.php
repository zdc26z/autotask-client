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
                        public float|array|null $id = null,
                        public ?bool $isActive = null,
                        public ?bool $isSerialized = null,
                        public ?string $name = null,
                        public ?int $productBillingCodeID = null,
                        public ?int $billingType = null,
                        public ?int $chargeBillingCodeID = null,
                        public ?int $createdByResourceID = null,
                #[CastCarbon]
                public ?Carbon $createdTime = null,
                        public ?int $defaultInstalledProductCategoryID = null,
                        public ?int $defaultVendorID = null,
                        public ?string $description = null,
                        public ?bool $doesNotRequireProcurement = null,
                        public ?string $externalProductID = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?string $internalProductID = null,
                        public ?bool $isEligibleForRma = null,
                        public ?string $link = null,
                        public ?string $manufacturerName = null,
                        public ?string $manufacturerProductName = null,
                        public ?float $markupRate = null,
                        public ?float $msrp = null,
                        public ?int $periodType = null,
                        public ?int $priceCostMethod = null,
                        public ?int $productCategory = null,
                        public ?string $sku = null,
                        public ?float $unitCost = null,
                        public ?float $unitPrice = null,
                        public ?string $vendorProductNumber = null,
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
