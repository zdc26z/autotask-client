<?php

namespace Anteris\Autotask\API\ExpenseItems;

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
 * Represents ExpenseItem entities.
 */
class ExpenseItemEntity extends Entity
{

    /**
     * Creates a new ExpenseItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?string $description = null,
        public ?int $expenseCategory = null,
        #[CastCarbon]
        public ?Carbon $expenseDate = null,
        public ?int $expenseReportID = null,
        public ?bool $haveReceipt = null,
        public ?float $id = null,
        public ?bool $isBillableToCompany = null,
        public ?int $paymentType = null,
        public ?int $companyID = null,
        public ?string $destination = null,
        public ?string $entertainmentLocation = null,
        public ?float $expenseCurrencyExpenseAmount = null,
        public ?int $expenseCurrencyID = null,
        public ?string $gLCode = null,
        public ?float $internalCurrencyExpenseAmount = null,
        public ?float $internalCurrencyReimbursementAmount = null,
        public ?bool $isReimbursable = null,
        public ?bool $isRejected = null,
        public ?float $miles = null,
        public ?float $odometerEnd = null,
        public ?float $odometerStart = null,
        public ?string $origin = null,
        public ?int $projectID = null,
        public ?string $purchaseOrderNumber = null,
        public ?float $reimbursementCurrencyReimbursementAmount = null,
        public ?int $taskID = null,
        public ?int $ticketID = null,
        public ?int $workType = null,
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
