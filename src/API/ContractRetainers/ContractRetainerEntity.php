<?php

namespace Anteris\Autotask\API\ContractRetainers;

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
                        public float|array|null $amount = null,
                        public ?int $contractID = null,
                #[CastCarbon]
                public ?Carbon $datePurchased = null,
                #[CastCarbon]
                public ?Carbon $endDate = null,
                        public ?int $id = null,
                #[CastCarbon]
                public ?Carbon $startDate = null,
                        public ?int $status = null,
                        public ?float $amountApproved = null,
                        public ?float $internalCurrencyAmount = null,
                        public ?float $internalCurrencyAmountApproved = null,
                        public ?string $invoiceNumber = null,
                        public ?bool $isPaid = null,
                        public ?int $paymentID = null,
                        public ?string $paymentNumber = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($amount)) {
            foreach($amount as $prop => $value) {
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
