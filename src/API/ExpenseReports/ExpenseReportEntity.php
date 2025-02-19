<?php

namespace Anteris\Autotask\API\ExpenseReports;

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
                        public float|array|null $id = null,
                        public ?string $name = null,
                        public ?int $submitterID = null,
                #[CastCarbon]
                public ?Carbon $weekEnding = null,
                        public ?float $amountDue = null,
                #[CastCarbon]
                public ?Carbon $approvedDate = null,
                        public ?int $approverID = null,
                        public ?string $departmentNumber = null,
                        public ?float $internalCurrencyCashAdvanceAmount = null,
                        public ?float $internalCurrencyExpenseTotal = null,
                        public ?int $organizationalLevelAssociationID = null,
                        public ?string $quickBooksReferenceNumber = null,
                        public ?float $reimbursementCurrencyAmountDue = null,
                        public ?float $reimbursementCurrencyCashAdvanceAmount = null,
                        public ?int $reimbursementCurrencyID = null,
                        public ?string $rejectionReason = null,
                        public ?int $status = null,
                        public ?bool $submit = null,
                #[CastCarbon]
                public ?Carbon $submitDate = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($id)) {
            foreach($id as $prop => $value) {
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
