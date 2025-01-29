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
        public ?int $companyID, 
public ?float $id, 
public ?string $name, 
public ?string $address1, 
public ?string $address2, 
public ?string $alternatePhone1, 
public ?string $alternatePhone2, 
public ?string $city, 
public ?int $countryID, 
public ?string $description, 
public ?string $fax, 
public ?bool $isActive, 
public ?bool $isPrimary, 
public ?bool $isTaxExempt, 
public ?bool $overrideCompanyTaxSettings, 
public ?string $phone, 
public ?string $postalCode, 
public ?float $roundtripDistance, 
public ?string $state, 
public ?int $taxRegionID, 
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
