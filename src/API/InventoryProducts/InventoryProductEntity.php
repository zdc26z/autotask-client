<?php

namespace Anteris\Autotask\API\InventoryProducts;

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
 * Represents InventoryProduct entities.
 */
class InventoryProductEntity extends Entity
{

    /**
     * Creates a new InventoryProduct entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $availableUnits, 
public ?float $id, 
public ?int $inventoryLocationID, 
public ?int $productID, 
public ?int $quantityMaximum, 
public ?int $quantityMinimum, 
public ?int $backOrderQuantity, 
public ?string $bin, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $createdByResourceID, 
public ?int $onHandUnits, 
public ?int $pickedUnits, 
public ?string $referenceNumber, 
public ?int $reservedUnits, 
public ?int $unitsOnOrder, 
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
