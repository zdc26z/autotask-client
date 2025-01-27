<?php

namespace Anteris\Autotask\API\ContractBillingRules;

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
 * Represents ContractBillingRule entities.
 */
class ContractBillingRuleEntity extends Entity
{

    /**
     * Creates a new ContractBillingRule entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $contractID, 
                public bool $createChargesAsBillable, 
                public float $dailyProratedCost = '', 
                public float $dailyProratedPrice = '', 
                public int $determineUnits, 
        #[CastCarbon]
                public Carbon $endDate = new Carbon(), 
                public int $executionMethod = '', 
                public int $id, 
                public bool $includeItemsInChargeDescription, 
                public string $invoiceDescription = '', 
                public bool $isActive, 
                public bool $isDailyProrationEnabled, 
                public int $maximumUnits = '', 
                public int $minimumUnits = '', 
                public int $productID, 
        #[CastCarbon]
                public Carbon $startDate, 
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
