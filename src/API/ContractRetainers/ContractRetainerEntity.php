<?php

namespace Anteris\Autotask\API\ContractRetainers;

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
 * Represents ContractRetainer entities.
 */
class ContractRetainerEntity extends Entity
{

    /**
     * Creates a new ContractRetainer entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public float $amount, 
                public float $amountApproved = '', 
                public int $contractID, 
        #[CastCarbon]
                public Carbon $datePurchased, 
        #[CastCarbon]
                public Carbon $endDate, 
                public int $id, 
                public float $internalCurrencyAmount = '', 
                public float $internalCurrencyAmountApproved = '', 
                public string $invoiceNumber = '', 
                public bool $isPaid = false, 
                public int $paymentID = '', 
                public string $paymentNumber = '', 
        #[CastCarbon]
                public Carbon $startDate, 
                public int $status, 
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
