<?php

namespace Anteris\Autotask\API\CompanyLocations;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents CompanyLocation entities.
 */
class CompanyLocationEntity extends Entity
{

    /**
     * Creates a new CompanyLocation entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $companyID = null,
        public ?float $id = null,
        public ?string $name = null,
        public ?string $address1 = null,
        public ?string $address2 = null,
        public ?string $alternatePhone1 = null,
        public ?string $alternatePhone2 = null,
        public ?string $city = null,
        public ?int $countryID = null,
        public ?string $description = null,
        public ?string $fax = null,
        public ?bool $isActive = null,
        public ?bool $isPrimary = null,
        public ?bool $isTaxExempt = null,
        public ?bool $overrideCompanyTaxSettings = null,
        public ?string $phone = null,
        public ?string $postalCode = null,
        public ?float $roundtripDistance = null,
        public ?string $state = null,
        public ?int $taxRegionID = null,
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
