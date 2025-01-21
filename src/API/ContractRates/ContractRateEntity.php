<?php

namespace Anteris\Autotask\API\ContractRates;

use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents ContractRate entities.
 */
class ContractRateEntity extends Data
{
    public float $contractHourlyRate;
    public int $contractID;
    public $id;
    public ?float $internalCurrencyContractHourlyRate;
    public int $roleID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new ContractRate entity.
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
