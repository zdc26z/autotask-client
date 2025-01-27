<?php

namespace Anteris\Autotask\API\Phases;

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
 * Represents Phase entities.
 */
class PhaseEntity extends Entity
{

    /**
     * Creates a new Phase entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
            #[CastCarbon]
                public Carbon $createDate = new Carbon(), 
                public int $creatorResourceID = '', 
                public string $description = '', 
        #[CastCarbon]
                public Carbon $dueDate = new Carbon(), 
                public float $estimatedHours = '', 
                public string $externalID = '', 
                public int $id, 
                public bool $isScheduled = false, 
        #[CastCarbon]
                public Carbon $lastActivityDateTime = new Carbon(), 
                public int $parentPhaseID = '', 
                public string $phaseNumber = '', 
                public int $projectID, 
        #[CastCarbon]
                public Carbon $startDate = new Carbon(), 
                public string $title, 
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
