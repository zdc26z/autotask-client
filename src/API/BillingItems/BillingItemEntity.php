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
        public ?int $billingItemType, 
public ?float $id, 
public ?int $nonBillable, 
public ?int $subType, 
public ?int $accountManagerWhenApprovedID, 
public ?int $billingCodeID, 
public ?int $companyID, 
public ?float $configurationItemID, 
public ?int $contractBlockID, 
public ?float $contractChargeID, 
public ?int $contractID, 
public ?int $contractServiceAdjustmentID, 
public ?int $contractServiceBundleAdjustmentID, 
public ?int $contractServiceBundleID, 
public ?int $contractServiceBundlePeriodID, 
public ?int $contractServiceID, 
public ?int $contractServicePeriodID, 
public ?string $description, 
public ?int $expenseItemID, 
public ?float $extendedPrice, 
public ?float $internalCurrencyExtendedPrice, 
public ?float $internalCurrencyRate, 
public ?float $internalCurrencyTaxDollars, 
public ?float $internalCurrencyTotalAmount, 
public ?int $invoiceID, 
public ?int $itemApproverID, 
#[CastCarbon]
        public ?Carbon $itemDate, 
public ?string $itemName, 
public ?string $lineItemFullDescription, 
public ?string $lineItemGroupDescription, 
public ?float $milestoneID, 
public ?int $organizationalLevelAssociationID, 
public ?float $ourCost, 
#[CastCarbon]
        public ?Carbon $postedDate, 
#[CastCarbon]
        public ?Carbon $postedOnTime, 
public ?float $projectChargeID, 
public ?int $projectID, 
public ?string $purchaseOrderNumber, 
public ?float $quantity, 
public ?float $rate, 
public ?int $roleID, 
public ?float $serviceBundleID, 
public ?float $serviceID, 
public ?float $sortOrderID, 
public ?int $taskID, 
public ?float $taxDollars, 
public ?float $ticketChargeID, 
public ?int $ticketID, 
public ?int $timeEntryID, 
public ?float $totalAmount, 
public ?float $vendorID, 
#[CastCarbon]
        public ?Carbon $webServiceDate, 
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
