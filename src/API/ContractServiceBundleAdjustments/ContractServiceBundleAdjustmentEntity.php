<?php

namespace Anteris\Autotask\API\ContractServiceBundleAdjustments;

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
 * Represents ContractServiceBundleAdjustment entities.
 */
class ContractServiceBundleAdjustmentEntity extends Entity
{

                /**
     * Creates a new ContractServiceBundleAdjustment entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                #[CastCarbon]
                public Carbon|array|null $effectiveDate = null,
                        public ?float $id = null,
                        public ?float $adjustedUnitPrice = null,
                        public ?bool $allowRepeatServiceBundle = null,
                        public ?int $contractID = null,
                        public ?int $contractServiceBundleID = null,
                        public ?int $quoteItemID = null,
                        public ?int $serviceBundleID = null,
                        public ?int $unitChange = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($effectiveDate)) {
            foreach($effectiveDate as $prop => $value) {
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
