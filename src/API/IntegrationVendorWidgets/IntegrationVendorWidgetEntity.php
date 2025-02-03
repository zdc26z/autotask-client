<?php

namespace Anteris\Autotask\API\IntegrationVendorWidgets;

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
 * Represents IntegrationVendorWidget entities.
 */
class IntegrationVendorWidgetEntity extends Entity
{

    /**
     * Creates a new IntegrationVendorWidget entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?float $id = null,
        public ?string $referenceUrl = null,
        public ?string $secret = null,
        public ?string $title = null,
        public ?string $vendorSuppliedID = null,
        public ?string $widgetKey = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?string $description = null,
        public ?bool $isActive = null,
        #[CastCarbon]
        public ?Carbon $lastModifiedDateTime = null,
        public ?int $width = null,
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
