<?php

namespace Anteris\Autotask\API\ContractMilestones;

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
 * Represents ContractMilestone entities.
 */
class ContractMilestoneEntity extends Entity
{

    /**
     * Creates a new ContractMilestone entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $amount = null,
        public ?int $contractID = null,
        #[CastCarbon]
        public ?Carbon $dateDue = null,
        public ?float $id = null,
        public ?bool $isInitialPayment = null,
        public ?int $status = null,
        public ?string $title = null,
        public ?int $billingCodeID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $creatorResourceID = null,
        public ?string $description = null,
        public ?float $internalCurrencyAmount = null,
        public ?int $organizationalLevelAssociationID = null,
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
