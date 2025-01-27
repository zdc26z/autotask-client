<?php

namespace Anteris\Autotask\API\InventoryStockedItems;

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
                    public int $availableUnits = '', 
                public int $companyID = '', 
                public int $configurationItemID = '', 
                public int $contractChargeID = '', 
        #[CastCarbon]
                public Carbon $createDateTime = new Carbon(), 
                public int $createdByResourceID = '', 
                public int $currentInventoryLocationID = '', 
                public int $deliveredUnits = '', 
                public int $id, 
                public int $inventoryProductID, 
                public int $onHandUnits = '', 
                public int $parentInventoryStockedItemID = '', 
                public int $parentStockedItemReceivedUnits = '', 
                public int $pickedRemovedByResourceID = '', 
        #[CastCarbon]
                public Carbon $pickedRemovedDateTime = new Carbon(), 
                public int $pickedUnits = '', 
                public int $projectChargeID = '', 
                public int $purchaseOrderID = '', 
                public int $purchaseOrderItemID = '', 
                public int $purchaseOrderItemReceivingID = '', 
                public int $quoteItemID = '', 
                public int $removedUnits = '', 
                public int $reservedUnits = '', 
                public float $returnPrice = '', 
                public int $returnTypeID = '', 
                public string $serialNumber = '', 
                public int $statusID = '', 
                public int $ticketChargeID = '', 
                public int $transferredUnits = '', 
                public float $unitCost, 
                public int $vendorID = '', 
                public string $vendorInvoiceNumber = '', 
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
