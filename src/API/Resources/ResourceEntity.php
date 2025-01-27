<?php

namespace Anteris\Autotask\API\Resources;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Generator\Helpers\CastCarbon;
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
                    public string $accountingReferenceID = '', 
                public string $dateFormat = '', 
                public int $defaultServiceDeskRoleID = '', 
                public string $email, 
                public string $email2 = '', 
                public string $email3 = '', 
                public string $emailTypeCode, 
                public string $emailTypeCode2 = '', 
                public string $emailTypeCode3 = '', 
                public string $firstName, 
                public string $gender = '', 
                public int $greeting = '', 
        #[CastCarbon]
                public Carbon $hireDate, 
                public string $homePhone = '', 
                public int $id, 
                public string $initials = '', 
                public float $internalCost = '', 
                public bool $isActive, 
                public string $lastName, 
                public int $licenseType, 
                public int $locationID, 
                public string $middleName = '', 
                public string $mobilePhone = '', 
                public string $numberFormat, 
                public string $officeExtension = '', 
                public string $officePhone = '', 
                public string $payrollIdentifier = '', 
                public int $payrollType, 
                public string $resourceType, 
                public int $suffix = '', 
                public float $surveyResourceRating = '', 
                public string $timeFormat = '', 
                public string $title = '', 
                public string $travelAvailabilityPct = '', 
                public string $userName, 
                public int $userType, 
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
