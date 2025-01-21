<?php

namespace Anteris\Autotask\API\BillingCodes;

use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents BillingCode entities.
 */
class BillingCodeEntity extends Data
{
    public ?int $afterHoursWorkType;
    public ?int $billingCodeType;
    public ?int $department;
    public ?string $description;
    public ?string $externalNumber;
    public ?int $generalLedgerAccount;
    public $id;
    public bool $isActive;
    public ?bool $isExcludedFromNewContracts;
    public ?float $markupRate;
    public ?string $name;
    public ?int $taxCategoryID;
    public float $unitCost;
    public float $unitPrice;
    public ?int $useType;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new BillingCode entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
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

        return new self($responseArray['item']);
    }
}
