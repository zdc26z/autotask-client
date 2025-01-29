<?php

namespace Anteris\Autotask\API\Contacts;

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
        public ?int $companyID, 
public ?string $firstName, 
public ?float $id, 
public ?int $isActive, 
public ?string $lastName, 
public ?string $additionalAddressInformation, 
public ?string $addressLine, 
public ?string $addressLine1, 
public ?string $alternatePhone, 
public ?int $apiVendorID, 
#[CastCarbon]
        public ?Carbon $bulkEmailOptOutTime, 
public ?string $city, 
public ?int $companyLocationID, 
public ?int $countryID, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?string $emailAddress, 
public ?string $emailAddress2, 
public ?string $emailAddress3, 
public ?string $extension, 
public ?string $externalID, 
public ?string $facebookUrl, 
public ?string $faxNumber, 
public ?int $impersonatorCreatorResourceID, 
public ?bool $isOptedOutFromBulkEmail, 
#[CastCarbon]
        public ?Carbon $lastActivityDate, 
#[CastCarbon]
        public ?Carbon $lastModifiedDate, 
public ?string $linkedInUrl, 
public ?string $middleInitial, 
public ?string $mobilePhone, 
public ?int $namePrefix, 
public ?int $nameSuffix, 
public ?string $note, 
public ?string $phone, 
public ?bool $primaryContact, 
public ?bool $receivesEmailNotifications, 
public ?string $roomNumber, 
public ?bool $solicitationOptOut, 
#[CastCarbon]
        public ?Carbon $solicitationOptOutTime, 
public ?string $state, 
public ?bool $surveyOptOut, 
public ?string $title, 
public ?string $twitterUrl, 
public ?string $zipCode, 
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
