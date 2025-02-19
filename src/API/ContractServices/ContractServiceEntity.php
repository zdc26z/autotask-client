<?php

namespace Anteris\Autotask\API\ContractServices;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ContractService entities.
 */
class ContractServiceEntity extends Entity
{

                /**
     * Creates a new ContractService entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public int|array|null $contractID = null,
                        public ?float $id = null,
                        public ?int $serviceID = null,
                        public ?float $internalCurrencyAdjustedPrice = null,
                        public ?float $internalCurrencyUnitPrice = null,
                        public ?string $internalDescription = null,
                        public ?string $invoiceDescription = null,
                        public ?float $quoteItemID = null,
                        public ?float $unitCost = null,
                        public ?float $unitPrice = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($contractID)) {
            foreach($contractID as $prop => $value) {
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
