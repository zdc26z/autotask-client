<?php

namespace Anteris\Autotask\API\PurchaseOrders;

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
 * Represents PurchaseOrder entities.
 */
class PurchaseOrderEntity extends Entity
{

                /**
     * Creates a new PurchaseOrder entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public float|array|null $id = null,
                        public ?string $shipToAddress1 = null,
                        public ?string $shipToName = null,
                        public ?int $status = null,
                        public ?int $vendorID = null,
                        public ?string $additionalVendorInvoiceNumbers = null,
                #[CastCarbon]
                public ?Carbon $cancelDateTime = null,
                #[CastCarbon]
                public ?Carbon $createDateTime = null,
                        public ?int $creatorResourceID = null,
                        public ?string $externalPONumber = null,
                        public ?string $fax = null,
                        public ?float $freight = null,
                        public ?string $generalMemo = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?float $internalCurrencyFreight = null,
                #[CastCarbon]
                public ?Carbon $latestEstimatedArrivalDate = null,
                        public ?int $paymentTerm = null,
                        public ?string $phone = null,
                        public ?int $purchaseForCompanyID = null,
                        public ?string $purchaseOrderNumber = null,
                        public ?int $purchaseOrderTemplateID = null,
                #[CastCarbon]
                public ?Carbon $shippingDate = null,
                        public ?int $shippingType = null,
                        public ?string $shipToAddress2 = null,
                        public ?string $shipToCity = null,
                        public ?string $shipToPostalCode = null,
                        public ?string $shipToState = null,
                        public ?bool $showEachTaxInGroup = null,
                        public ?bool $showTaxCategory = null,
                #[CastCarbon]
                public ?Carbon $submitDateTime = null,
                        public ?int $taxRegionID = null,
                        public ?int $useItemDescriptionsFrom = null,
                        public ?string $vendorInvoiceNumber = null,
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
