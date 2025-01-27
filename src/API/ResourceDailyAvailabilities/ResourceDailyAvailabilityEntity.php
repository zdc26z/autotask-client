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
                    public float $fridayAvailableHours = '', 
                public int $id, 
                public float $mondayAvailableHours = '', 
                public int $resourceID, 
                public float $saturdayAvailableHours = '', 
                public float $sundayAvailableHours = '', 
                public float $thursdayAvailableHours = '', 
                public string $travelAvailability = '', 
                public float $tuesdayAvailableHours = '', 
                public float $wednesdayAvailableHours = '', 
                public float $weeklyBillableHoursGoal = '', 
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
