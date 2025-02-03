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
                public ?int $availableUnits = null,
        public ?float $id = null,
        public ?int $inventoryLocationID = null,
        public ?int $productID = null,
        public ?int $quantityMaximum = null,
        public ?int $quantityMinimum = null,
        public ?int $backOrderQuantity = null,
        public ?string $bin = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?int $createdByResourceID = null,
        public ?int $onHandUnits = null,
        public ?int $pickedUnits = null,
        public ?string $referenceNumber = null,
        public ?int $reservedUnits = null,
        public ?int $unitsOnOrder = null,
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
