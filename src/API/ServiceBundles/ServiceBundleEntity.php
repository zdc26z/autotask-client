<?php

namespace Anteris\Autotask\API\ServiceBundles;

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
 * Represents ServiceBundle entities.
 */
class ServiceBundleEntity extends Entity
{

    /**
     * Creates a new ServiceBundle entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $billingCodeID = null,
        public ?float $id = null,
        public ?string $name = null,
        public ?int $periodType = null,
        public ?string $catalogNumberPartNumber = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $creatorResourceID = null,
        public ?string $description = null,
        public ?string $externalID = null,
        public ?string $internalID = null,
        public ?string $invoiceDescription = null,
        public ?bool $isActive = null,
        #[CastCarbon]
        public ?Carbon $lastModifiedDate = null,
        public ?string $manufacturerServiceProvider = null,
        public ?string $manufacturerServiceProviderProductNumber = null,
        public ?float $percentageDiscount = null,
        public ?float $serviceLevelAgreementID = null,
        public ?string $sku = null,
        public ?float $unitCost = null,
        public ?float $unitDiscount = null,
        public ?float $unitPrice = null,
        public ?int $updateResourceID = null,
        public ?string $url = null,
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
