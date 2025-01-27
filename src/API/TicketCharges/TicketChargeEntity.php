<?php

namespace Anteris\Autotask\API\TicketCharges;

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
 * Represents TicketCharge entities.
 */
class TicketChargeEntity extends Entity
{

    /**
     * Creates a new TicketCharge entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public float $billableAmount = '', 
                public int $billingCodeID = '', 
                public int $chargeType, 
                public int $contractServiceBundleID = '', 
                public int $contractServiceID = '', 
        #[CastCarbon]
                public Carbon $createDate = new Carbon(), 
                public int $creatorResourceID = '', 
        #[CastCarbon]
                public Carbon $datePurchased, 
                public string $description = '', 
                public float $extendedCost = '', 
                public int $id, 
                public float $internalCurrencyBillableAmount = '', 
                public float $internalCurrencyUnitPrice = '', 
                public string $internalPurchaseOrderNumber = '', 
                public bool $isBillableToCompany = false, 
                public bool $isBilled = false, 
                public string $name, 
                public string $notes = '', 
                public int $organizationalLevelAssociationID = '', 
                public int $productID = '', 
                public string $purchaseOrderNumber = '', 
                public int $status = '', 
                public int $statusLastModifiedBy = '', 
        #[CastCarbon]
                public Carbon $statusLastModifiedDate = new Carbon(), 
                public int $ticketID, 
                public float $unitCost = '', 
                public float $unitPrice = '', 
                public float $unitQuantity, 
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
