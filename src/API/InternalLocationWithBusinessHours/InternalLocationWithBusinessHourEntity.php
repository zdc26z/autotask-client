<?php

namespace Anteris\Autotask\API\InternalLocationWithBusinessHours;

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
 * Represents InternalLocationWithBusinessHour entities.
 */
class InternalLocationWithBusinessHourEntity extends Entity
{

    /**
     * Creates a new InternalLocationWithBusinessHour entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?string $dateFormat, 
public ?float $id, 
public ?string $name, 
public ?string $numberFormat, 
public ?string $timeFormat, 
public ?int $timeZoneID, 
public ?string $additionalAddressInfo, 
public ?string $address1, 
public ?string $address2, 
public ?string $city, 
public ?int $countryID, 
public ?int $firstDayOfWeek, 
#[CastCarbon]
        public ?Carbon $fridayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $fridayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $fridayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $fridayExtendedHoursStartTime, 
#[CastCarbon]
        public ?Carbon $holidayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $holidayExtendedHoursStartTime, 
#[CastCarbon]
        public ?Carbon $holidayHoursEndTime, 
#[CastCarbon]
        public ?Carbon $holidayHoursStartTime, 
public ?int $holidayHoursType, 
public ?int $holidaySetID, 
public ?bool $isDefault, 
#[CastCarbon]
        public ?Carbon $mondayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $mondayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $mondayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $mondayExtendedHoursStartTime, 
public ?bool $noHoursOnHolidays, 
public ?string $postalCode, 
#[CastCarbon]
        public ?Carbon $saturdayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $saturdayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $saturdayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $saturdayExtendedHoursStartTime, 
public ?string $state, 
#[CastCarbon]
        public ?Carbon $sundayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $sundayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $sundayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $sundayExtendedHoursStartTime, 
#[CastCarbon]
        public ?Carbon $thursdayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $thursdayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $thursdayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $thursdayExtendedHoursStartTime, 
#[CastCarbon]
        public ?Carbon $tuesdayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $tuesdayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $tuesdayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $tuesdayExtendedHoursStartTime, 
#[CastCarbon]
        public ?Carbon $wednesdayBusinessHoursEndTime, 
#[CastCarbon]
        public ?Carbon $wednesdayBusinessHoursStartTime, 
#[CastCarbon]
        public ?Carbon $wednesdayExtendedHoursEndTime, 
#[CastCarbon]
        public ?Carbon $wednesdayExtendedHoursStartTime, 
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
