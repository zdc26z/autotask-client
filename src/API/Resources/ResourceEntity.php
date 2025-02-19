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
                        public string|array|null $email = null,
                        public ?string $emailTypeCode = null,
                        public ?string $firstName = null,
                #[CastCarbon]
                public ?Carbon $hireDate = null,
                        public ?float $id = null,
                        public ?bool $isActive = null,
                        public ?string $lastName = null,
                        public ?int $licenseType = null,
                        public ?int $locationID = null,
                        public ?string $numberFormat = null,
                        public ?int $payrollType = null,
                        public ?string $resourceType = null,
                        public ?string $userName = null,
                        public ?int $userType = null,
                        public ?string $accountingReferenceID = null,
                        public ?string $dateFormat = null,
                        public ?float $defaultServiceDeskRoleID = null,
                        public ?string $email2 = null,
                        public ?string $email3 = null,
                        public ?string $emailTypeCode2 = null,
                        public ?string $emailTypeCode3 = null,
                        public ?string $gender = null,
                        public ?int $greeting = null,
                        public ?string $homePhone = null,
                        public ?string $initials = null,
                        public ?float $internalCost = null,
                        public ?string $middleName = null,
                        public ?string $mobilePhone = null,
                        public ?string $officeExtension = null,
                        public ?string $officePhone = null,
                        public ?string $payrollIdentifier = null,
                        public ?int $suffix = null,
                        public ?float $surveyResourceRating = null,
                        public ?string $timeFormat = null,
                        public ?string $title = null,
                        public ?string $travelAvailabilityPct = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($email)) {
            foreach($email as $prop => $value) {
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
