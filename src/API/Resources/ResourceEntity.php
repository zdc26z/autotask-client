<?php

namespace Anteris\Autotask\API\Resources;

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
 * Represents Resource entities.
 */
class ResourceEntity extends Entity
{

    /**
     * Creates a new Resource entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?string $email, 
public ?string $emailTypeCode, 
public ?string $firstName, 
#[CastCarbon]
        public ?Carbon $hireDate, 
public ?float $id, 
public ?bool $isActive, 
public ?string $lastName, 
public ?int $licenseType, 
public ?int $locationID, 
public ?string $numberFormat, 
public ?int $payrollType, 
public ?string $resourceType, 
public ?string $userName, 
public ?int $userType, 
public ?string $accountingReferenceID, 
public ?string $dateFormat, 
public ?float $defaultServiceDeskRoleID, 
public ?string $email2, 
public ?string $email3, 
public ?string $emailTypeCode2, 
public ?string $emailTypeCode3, 
public ?string $gender, 
public ?int $greeting, 
public ?string $homePhone, 
public ?string $initials, 
public ?float $internalCost, 
public ?string $middleName, 
public ?string $mobilePhone, 
public ?string $officeExtension, 
public ?string $officePhone, 
public ?string $payrollIdentifier, 
public ?int $suffix, 
public ?float $surveyResourceRating, 
public ?string $timeFormat, 
public ?string $title, 
public ?string $travelAvailabilityPct, 
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
