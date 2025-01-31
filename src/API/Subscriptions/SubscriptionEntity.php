<?php

namespace Anteris\Autotask\API\Subscriptions;

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
 * Represents Subscription entities.
 */
class SubscriptionEntity extends Entity
{

    /**
     * Creates a new Subscription entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $configurationItemID, 
#[CastCarbon]
        public ?Carbon $effectiveDate, 
#[CastCarbon]
        public ?Carbon $expirationDate, 
public ?float $id, 
public ?int $materialCodeID, 
public ?float $periodPrice, 
public ?int $periodType, 
public ?int $status, 
public ?string $subscriptionName, 
public ?string $description, 
public ?int $impersonatorCreatorResourceID, 
public ?int $organizationalLevelAssociationID, 
public ?float $periodCost, 
public ?string $purchaseOrderNumber, 
public ?float $totalCost, 
public ?float $totalPrice, 
public ?int $vendorID, 
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
