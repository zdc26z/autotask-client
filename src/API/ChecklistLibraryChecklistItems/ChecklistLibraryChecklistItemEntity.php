<?php

namespace Anteris\Autotask\API\ChecklistLibraryChecklistItems;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ChecklistLibraryChecklistItem entities.
 */
class ChecklistLibraryChecklistItemEntity extends Entity
{

                /**
     * Creates a new ChecklistLibraryChecklistItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public int|array|null $checklistLibraryID = null,
                        public ?float $id = null,
                        public ?string $itemName = null,
                        public ?bool $isImportant = null,
                        public ?int $knowledgebaseArticleID = null,
                        public ?int $position = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($checklistLibraryID)) {
            foreach($checklistLibraryID as $prop => $value) {
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
