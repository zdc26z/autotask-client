<?php

namespace Anteris\Autotask\API\ContractServiceUnits;

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
 * Represents ContractServiceUnit entities.
 */
class ContractServiceUnitEntity extends Entity
{

    /**
     * Creates a new ContractServiceUnit entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $contractID, 
#[CastCarbon]
        public ?Carbon $endDate, 
public ?float $id, 
public ?int $serviceID, 
#[CastCarbon]
        public ?Carbon $startDate, 
public ?int $units, 
#[CastCarbon]
        public ?Carbon $approveAndPostDate, 
public ?int $contractServiceID, 
public ?float $cost, 
public ?float $internalCurrencyPrice, 
public ?int $organizationalLevelAssociationID, 
public ?float $price, 
public ?int $vendorCompanyID, 
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
