<?php

namespace Anteris\Autotask\API\Phases;

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
                public ?float $id = null,
        public ?int $projectID = null,
        public ?string $title = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $creatorResourceID = null,
        public ?string $description = null,
        #[CastCarbon]
        public ?Carbon $dueDate = null,
        public ?float $estimatedHours = null,
        public ?string $externalID = null,
        public ?bool $isScheduled = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDateTime = null,
        public ?int $parentPhaseID = null,
        public ?string $phaseNumber = null,
        #[CastCarbon]
        public ?Carbon $startDate = null,
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
