<?php

namespace Anteris\Autotask\API\BillingItems;

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
 * Represents BillingItem entities.
 */
class BillingItemEntity extends Entity
{

    /**
     * Creates a new BillingItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $billingItemType = null,
        public ?float $id = null,
        public ?int $nonBillable = null,
        public ?int $subType = null,
        public ?int $accountManagerWhenApprovedID = null,
        public ?int $billingCodeID = null,
        public ?int $companyID = null,
        public ?float $configurationItemID = null,
        public ?int $contractBlockID = null,
        public ?float $contractChargeID = null,
        public ?int $contractID = null,
        public ?int $contractServiceAdjustmentID = null,
        public ?int $contractServiceBundleAdjustmentID = null,
        public ?int $contractServiceBundleID = null,
        public ?int $contractServiceBundlePeriodID = null,
        public ?int $contractServiceID = null,
        public ?int $contractServicePeriodID = null,
        public ?string $description = null,
        public ?int $expenseItemID = null,
        public ?float $extendedPrice = null,
        public ?float $internalCurrencyExtendedPrice = null,
        public ?float $internalCurrencyRate = null,
        public ?float $internalCurrencyTaxDollars = null,
        public ?float $internalCurrencyTotalAmount = null,
        public ?int $invoiceID = null,
        public ?int $itemApproverID = null,
        #[CastCarbon]
        public ?Carbon $itemDate = null,
        public ?string $itemName = null,
        public ?string $lineItemFullDescription = null,
        public ?string $lineItemGroupDescription = null,
        public ?float $milestoneID = null,
        public ?int $organizationalLevelAssociationID = null,
        public ?float $ourCost = null,
        #[CastCarbon]
        public ?Carbon $postedDate = null,
        #[CastCarbon]
        public ?Carbon $postedOnTime = null,
        public ?float $projectChargeID = null,
        public ?int $projectID = null,
        public ?string $purchaseOrderNumber = null,
        public ?float $quantity = null,
        public ?float $rate = null,
        public ?int $roleID = null,
        public ?float $serviceBundleID = null,
        public ?float $serviceID = null,
        public ?float $sortOrderID = null,
        public ?int $taskID = null,
        public ?float $taxDollars = null,
        public ?float $ticketChargeID = null,
        public ?int $ticketID = null,
        public ?int $timeEntryID = null,
        public ?float $totalAmount = null,
        public ?float $vendorID = null,
        #[CastCarbon]
        public ?Carbon $webServiceDate = null,
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
