<?php

namespace Anteris\Autotask\API\ChangeOrderCharges;

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
 * Represents ChangeOrderCharge entities.
 */
class ChangeOrderChargeEntity extends Entity
{

    /**
     * Creates a new ChangeOrderCharge entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $chargeType, 
#[CastCarbon]
        public ?Carbon $datePurchased, 
public ?float $id, 
public ?string $name, 
public ?int $taskID, 
public ?float $billableAmount, 
public ?int $billingCodeID, 
public ?float $changeOrderHours, 
public ?int $contractServiceBundleID, 
public ?int $contractServiceID, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?int $creatorResourceID, 
public ?string $description, 
public ?float $extendedCost, 
public ?float $internalCurrencyBillableAmount, 
public ?float $internalCurrencyUnitPrice, 
public ?string $internalPurchaseOrderNumber, 
public ?bool $isBillableToCompany, 
public ?bool $isBilled, 
public ?string $notes, 
public ?int $organizationalLevelAssociationID, 
public ?int $productID, 
public ?string $purchaseOrderNumber, 
public ?int $status, 
public ?int $statusLastModifiedBy, 
#[CastCarbon]
        public ?Carbon $statusLastModifiedDate, 
public ?float $unitCost, 
public ?float $unitPrice, 
public ?float $unitQuantity, 
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
