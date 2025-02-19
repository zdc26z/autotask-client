<?php

namespace Anteris\Autotask\API\TaskAttachments;

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
 * Represents TaskAttachment entities.
 */
class TaskAttachmentEntity extends Entity
{

                /**
     * Creates a new TaskAttachment entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public string|array|null $attachmentType = null,
                        public ?string $fullPath = null,
                        public ?float $id = null,
                        public ?int $publish = null,
                        public ?string $title = null,
                #[CastCarbon]
                public ?Carbon $attachDate = null,
                        public ?float $attachedByContactID = null,
                        public ?float $attachedByResourceID = null,
                        public ?string $contentType = null,
                        public ?int $creatorType = null,
                        public mixed $data = null,
                        public ?float $fileSize = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?float $opportunityID = null,
                        public ?int $parentAttachmentID = null,
                        public ?float $parentID = null,
                        public ?int $taskID = null,
                        public ?int $taskNoteID = null,
                        public ?int $timeEntryID = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($attachmentType)) {
            foreach($attachmentType as $prop => $value) {
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
