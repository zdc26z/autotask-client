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
                    public string $additionalAddressInfo = '', 
                public string $address1 = '', 
                public string $address2 = '', 
                public string $city = '', 
                public int $countryID = '', 
                public string $dateFormat, 
                public int $firstDayOfWeek = '', 
        #[CastCarbon]
                public Carbon $fridayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $fridayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $fridayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $fridayExtendedHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $holidayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $holidayExtendedHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $holidayHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $holidayHoursStartTime = new Carbon(), 
                public int $holidayHoursType = '', 
                public int $holidaySetID = '', 
                public int $id, 
                public bool $isDefault = false, 
        #[CastCarbon]
                public Carbon $mondayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $mondayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $mondayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $mondayExtendedHoursStartTime = new Carbon(), 
                public string $name, 
                public bool $noHoursOnHolidays = false, 
                public string $numberFormat, 
                public string $postalCode = '', 
        #[CastCarbon]
                public Carbon $saturdayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $saturdayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $saturdayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $saturdayExtendedHoursStartTime = new Carbon(), 
                public string $state = '', 
        #[CastCarbon]
                public Carbon $sundayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $sundayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $sundayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $sundayExtendedHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $thursdayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $thursdayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $thursdayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $thursdayExtendedHoursStartTime = new Carbon(), 
                public string $timeFormat, 
                public int $timeZoneID, 
        #[CastCarbon]
                public Carbon $tuesdayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $tuesdayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $tuesdayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $tuesdayExtendedHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $wednesdayBusinessHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $wednesdayBusinessHoursStartTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $wednesdayExtendedHoursEndTime = new Carbon(), 
        #[CastCarbon]
                public Carbon $wednesdayExtendedHoursStartTime = new Carbon(), 
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
