<?php

namespace Anteris\Autotask\API\PurchaseOrders;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Generator\Helpers\CastCarbon;
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
        public ?float $id, 
public ?string $shipToAddress1, 
public ?string $shipToName, 
public ?int $status, 
public ?int $vendorID, 
public ?string $additionalVendorInvoiceNumbers, 
#[CastCarbon]
        public ?Carbon $cancelDateTime, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $creatorResourceID, 
public ?string $externalPONumber, 
public ?string $fax, 
public ?float $freight, 
public ?string $generalMemo, 
public ?int $impersonatorCreatorResourceID, 
public ?float $internalCurrencyFreight, 
#[CastCarbon]
        public ?Carbon $latestEstimatedArrivalDate, 
public ?int $paymentTerm, 
public ?string $phone, 
public ?int $purchaseForCompanyID, 
public ?string $purchaseOrderNumber, 
public ?int $purchaseOrderTemplateID, 
#[CastCarbon]
        public ?Carbon $shippingDate, 
public ?int $shippingType, 
public ?string $shipToAddress2, 
public ?string $shipToCity, 
public ?string $shipToPostalCode, 
public ?string $shipToState, 
public ?bool $showEachTaxInGroup, 
public ?bool $showTaxCategory, 
#[CastCarbon]
        public ?Carbon $submitDateTime, 
public ?int $taxRegionID, 
public ?int $useItemDescriptionsFrom, 
public ?string $vendorInvoiceNumber, 
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
