<?php

namespace Anteris\Autotask\API\TicketCharges;

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
                        public int|array|null $chargeType = null,
                #[CastCarbon]
                public ?Carbon $datePurchased = null,
                        public ?float $id = null,
                        public ?string $name = null,
                        public ?float $ticketID = null,
                        public ?float $unitQuantity = null,
                        public ?float $billableAmount = null,
                        public ?float $billingCodeID = null,
                        public ?float $contractServiceBundleID = null,
                        public ?float $contractServiceID = null,
                #[CastCarbon]
                public ?Carbon $createDate = null,
                        public ?float $creatorResourceID = null,
                        public ?string $description = null,
                        public ?float $extendedCost = null,
                        public ?float $internalCurrencyBillableAmount = null,
                        public ?float $internalCurrencyUnitPrice = null,
                        public ?string $internalPurchaseOrderNumber = null,
                        public ?bool $isBillableToCompany = null,
                        public ?bool $isBilled = null,
                        public ?string $notes = null,
                        public ?int $organizationalLevelAssociationID = null,
                        public ?float $productID = null,
                        public ?string $purchaseOrderNumber = null,
                        public ?float $status = null,
                        public ?float $statusLastModifiedBy = null,
                #[CastCarbon]
                public ?Carbon $statusLastModifiedDate = null,
                        public ?float $unitCost = null,
                        public ?float $unitPrice = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($chargeType)) {
            foreach($chargeType as $prop => $value) {
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
