<?php

namespace Anteris\Autotask\API\Contacts;

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
 * Represents Contact entities.
 */
class ContactEntity extends Entity
{

    /**
     * Creates a new Contact entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $companyID = null,
        public ?string $firstName = null,
        public ?float $id = null,
        public ?int $isActive = null,
        public ?string $lastName = null,
        public ?string $additionalAddressInformation = null,
        public ?string $addressLine = null,
        public ?string $addressLine1 = null,
        public ?string $alternatePhone = null,
        public ?int $apiVendorID = null,
        #[CastCarbon]
        public ?Carbon $bulkEmailOptOutTime = null,
        public ?string $city = null,
        public ?int $companyLocationID = null,
        public ?int $countryID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?string $emailAddress = null,
        public ?string $emailAddress2 = null,
        public ?string $emailAddress3 = null,
        public ?string $extension = null,
        public ?string $externalID = null,
        public ?string $facebookUrl = null,
        public ?string $faxNumber = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?bool $isOptedOutFromBulkEmail = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDate = null,
        #[CastCarbon]
        public ?Carbon $lastModifiedDate = null,
        public ?string $linkedInUrl = null,
        public ?string $middleInitial = null,
        public ?string $mobilePhone = null,
        public ?int $namePrefix = null,
        public ?int $nameSuffix = null,
        public ?string $note = null,
        public ?string $phone = null,
        public ?bool $primaryContact = null,
        public ?bool $receivesEmailNotifications = null,
        public ?string $roomNumber = null,
        public ?bool $solicitationOptOut = null,
        #[CastCarbon]
        public ?Carbon $solicitationOptOutTime = null,
        public ?string $state = null,
        public ?bool $surveyOptOut = null,
        public ?string $title = null,
        public ?string $twitterUrl = null,
        public ?string $zipCode = null,
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
