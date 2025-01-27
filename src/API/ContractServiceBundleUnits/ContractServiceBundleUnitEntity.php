<?php

namespace Anteris\Autotask\API\ContractServiceBundleUnits;

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
 * Represents ContractServiceBundleUnit entities.
 */
class ContractServiceBundleUnitEntity extends Entity
{

    /**
     * Creates a new ContractServiceBundleUnit entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
            #[CastCarbon]
                public Carbon $approveAndPostDate = new Carbon(), 
                public int $contractID, 
                public int $contractServiceBundleID = '', 
                public float $cost = '', 
        #[CastCarbon]
                public Carbon $endDate, 
                public int $id, 
                public float $internalCurrencyPrice = '', 
                public int $organizationalLevelAssociationID = '', 
                public float $price = '', 
                public int $serviceBundleID, 
        #[CastCarbon]
                public Carbon $startDate, 
                public int $units, 
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
