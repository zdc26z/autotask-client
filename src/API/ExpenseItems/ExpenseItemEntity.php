<?php

namespace Anteris\Autotask\API\ExpenseItems;

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
                    public int $companyID = '', 
                public string $description, 
                public string $destination = '', 
                public string $entertainmentLocation = '', 
                public int $expenseCategory, 
                public float $expenseCurrencyExpenseAmount = '', 
                public int $expenseCurrencyID = '', 
        #[CastCarbon]
                public Carbon $expenseDate, 
                public int $expenseReportID, 
                public string $gLCode = '', 
                public bool $haveReceipt, 
                public int $id, 
                public float $internalCurrencyExpenseAmount = '', 
                public float $internalCurrencyReimbursementAmount = '', 
                public bool $isBillableToCompany, 
                public bool $isReimbursable = false, 
                public bool $isRejected = false, 
                public float $miles = '', 
                public float $odometerEnd = '', 
                public float $odometerStart = '', 
                public string $origin = '', 
                public int $paymentType, 
                public int $projectID = '', 
                public string $purchaseOrderNumber = '', 
                public float $reimbursementCurrencyReimbursementAmount = '', 
                public int $taskID = '', 
                public int $ticketID = '', 
                public int $workType = '', 
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
