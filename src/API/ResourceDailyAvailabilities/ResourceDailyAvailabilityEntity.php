<?php

namespace Anteris\Autotask\API\ResourceDailyAvailabilities;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ResourceDailyAvailability entities.
 */
class ResourceDailyAvailabilityEntity extends Entity
{

    /**
     * Creates a new ResourceDailyAvailability entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $id = null,
        public ?int $resourceID = null,
        public ?float $fridayAvailableHours = null,
        public ?float $mondayAvailableHours = null,
        public ?float $saturdayAvailableHours = null,
        public ?float $sundayAvailableHours = null,
        public ?float $thursdayAvailableHours = null,
        public ?string $travelAvailability = null,
        public ?float $tuesdayAvailableHours = null,
        public ?float $wednesdayAvailableHours = null,
        public ?float $weeklyBillableHoursGoal = null,
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
