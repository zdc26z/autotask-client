<?php

namespace Anteris\Autotask\API\InventoryStockedItems;

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
 * Represents InventoryStockedItem entities.
 */
class InventoryStockedItemEntity extends Entity
{

    /**
     * Creates a new InventoryStockedItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $id = null,
        public ?int $inventoryProductID = null,
        public ?float $unitCost = null,
        public ?int $availableUnits = null,
        public ?int $companyID = null,
        public ?int $configurationItemID = null,
        public ?int $contractChargeID = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?int $createdByResourceID = null,
        public ?int $currentInventoryLocationID = null,
        public ?int $deliveredUnits = null,
        public ?int $onHandUnits = null,
        public ?int $parentInventoryStockedItemID = null,
        public ?int $parentStockedItemReceivedUnits = null,
        public ?int $pickedRemovedByResourceID = null,
        #[CastCarbon]
        public ?Carbon $pickedRemovedDateTime = null,
        public ?int $pickedUnits = null,
        public ?int $projectChargeID = null,
        public ?int $purchaseOrderID = null,
        public ?int $purchaseOrderItemID = null,
        public ?int $purchaseOrderItemReceivingID = null,
        public ?int $quoteItemID = null,
        public ?int $removedUnits = null,
        public ?int $reservedUnits = null,
        public ?float $returnPrice = null,
        public ?int $returnTypeID = null,
        public ?string $serialNumber = null,
        public ?int $statusID = null,
        public ?int $ticketChargeID = null,
        public ?int $transferredUnits = null,
        public ?int $vendorID = null,
        public ?string $vendorInvoiceNumber = null,
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
