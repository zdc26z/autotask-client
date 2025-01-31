<?php

namespace Anteris\Autotask\API\ContractServiceBundleUnits;

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
        public ?int $contractID, 
#[CastCarbon]
        public ?Carbon $endDate, 
public ?int $id, 
public ?int $serviceBundleID, 
#[CastCarbon]
        public ?Carbon $startDate, 
public ?int $units, 
#[CastCarbon]
        public ?Carbon $approveAndPostDate, 
public ?int $contractServiceBundleID, 
public ?float $cost, 
public ?float $internalCurrencyPrice, 
public ?int $organizationalLevelAssociationID, 
public ?float $price, 
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
