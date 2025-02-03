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
                public ?int $configurationItemID = null,
        #[CastCarbon]
        public ?Carbon $effectiveDate = null,
        #[CastCarbon]
        public ?Carbon $expirationDate = null,
        public ?float $id = null,
        public ?int $materialCodeID = null,
        public ?float $periodPrice = null,
        public ?int $periodType = null,
        public ?int $status = null,
        public ?string $subscriptionName = null,
        public ?string $description = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?int $organizationalLevelAssociationID = null,
        public ?float $periodCost = null,
        public ?string $purchaseOrderNumber = null,
        public ?float $totalCost = null,
        public ?float $totalPrice = null,
        public ?int $vendorID = null,
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
