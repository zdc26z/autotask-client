<?php

namespace Anteris\Autotask\API\PurchaseOrderItems;

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
 * Represents PurchaseOrderItem entities.
 */
class PurchaseOrderItemEntity extends Entity
{

    /**
     * Creates a new PurchaseOrderItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $chargeID = '', 
                public int $contractID = '', 
        #[CastCarbon]
                public Carbon $estimatedArrivalDate = new Carbon(), 
                public int $id, 
                public float $internalCurrencyUnitCost = '', 
                public int $inventoryLocationID, 
                public string $memo = '', 
                public int $orderID, 
                public int $productID = '', 
                public int $projectID = '', 
                public int $quantity, 
                public int $salesOrderID = '', 
                public int $ticketID = '', 
                public float $unitCost, 
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
