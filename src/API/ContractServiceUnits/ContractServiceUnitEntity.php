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
                public ?int $contractID = null,
        #[CastCarbon]
        public ?Carbon $endDate = null,
        public ?float $id = null,
        public ?int $serviceID = null,
        #[CastCarbon]
        public ?Carbon $startDate = null,
        public ?int $units = null,
        #[CastCarbon]
        public ?Carbon $approveAndPostDate = null,
        public ?int $contractServiceID = null,
        public ?float $cost = null,
        public ?float $internalCurrencyPrice = null,
        public ?int $organizationalLevelAssociationID = null,
        public ?float $price = null,
        public ?int $vendorCompanyID = null,
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
