<?php

namespace Anteris\Autotask\API\Documents;

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
 * Represents Document entities.
 */
class DocumentEntity extends Entity
{

    /**
     * Creates a new Document entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $companyID = null,
        public ?int $documentCategoryID = null,
        public ?float $id = null,
        public ?int $publish = null,
        public ?string $title = null,
        public ?int $createdByResourceID = null,
        #[CastCarbon]
        public ?Carbon $createdDateTime = null,
        public ?string $errorCodes = null,
        public ?bool $isActive = null,
        public ?string $keywords = null,
        public ?int $lastModifiedByResourceID = null,
        #[CastCarbon]
        public ?Carbon $lastModifiedDateTime = null,
        public ?string $referenceLink = null,
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
