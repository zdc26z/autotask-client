<?php

namespace Anteris\Autotask\API\ExpenseReports;

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
 * Represents ExpenseReport entities.
 */
class ExpenseReportEntity extends Entity
{

    /**
     * Creates a new ExpenseReport entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?float $id, 
public ?string $name, 
public ?int $submitterID, 
#[CastCarbon]
        public ?Carbon $weekEnding, 
public ?float $amountDue, 
#[CastCarbon]
        public ?Carbon $approvedDate, 
public ?int $approverID, 
public ?string $departmentNumber, 
public ?float $internalCurrencyCashAdvanceAmount, 
public ?float $internalCurrencyExpenseTotal, 
public ?int $organizationalLevelAssociationID, 
public ?string $quickBooksReferenceNumber, 
public ?float $reimbursementCurrencyAmountDue, 
public ?float $reimbursementCurrencyCashAdvanceAmount, 
public ?int $reimbursementCurrencyID, 
public ?string $rejectionReason, 
public ?int $status, 
public ?bool $submit, 
#[CastCarbon]
        public ?Carbon $submitDate, 
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
