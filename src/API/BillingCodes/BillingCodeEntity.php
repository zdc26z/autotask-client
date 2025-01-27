<?php

namespace Anteris\Autotask\API\BillingCodes;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents BillingCode entities.
 */
class BillingCodeEntity extends Entity
{

    /**
     * Creates a new BillingCode entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $afterHoursWorkType = '', 
                public int $billingCodeType = '', 
                public int $department = '', 
                public string $description = '', 
                public string $externalNumber = '', 
                public int $generalLedgerAccount = '', 
                public int $id, 
                public bool $isActive, 
                public bool $isExcludedFromNewContracts = false, 
                public float $markupRate = '', 
                public string $name = '', 
                public int $taxCategoryID = '', 
                public float $unitCost, 
                public float $unitPrice, 
                public int $useType = '', 
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
