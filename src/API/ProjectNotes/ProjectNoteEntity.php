<?php

namespace Anteris\Autotask\API\ProjectNotes;

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
 * Represents ProjectNote entities.
 */
class ProjectNoteEntity extends Entity
{

                /**
     * Creates a new ProjectNote entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public string|array|null $description = null,
                        public ?float $id = null,
                        public ?bool $isAnnouncement = null,
                        public ?int $noteType = null,
                        public ?int $projectID = null,
                        public ?int $publish = null,
                        public ?string $title = null,
                #[CastCarbon]
                public ?Carbon $createDateTime = null,
                        public ?int $createdByContactID = null,
                        public ?int $creatorResourceID = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?int $impersonatorUpdaterResourceID = null,
                #[CastCarbon]
                public ?Carbon $lastActivityDate = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($description)) {
            foreach($description as $prop => $value) {
                if(property_exists($this, $prop)) {
                    $this->$prop = $value;
                }
            }
        }
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
