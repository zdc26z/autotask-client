<?php

namespace Anteris\Autotask\API\InternalLocationWithBusinessHours;

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
                        public string|array|null $dateFormat = null,
                        public ?float $id = null,
                        public ?string $name = null,
                        public ?string $numberFormat = null,
                        public ?string $timeFormat = null,
                        public ?int $timeZoneID = null,
                        public ?string $additionalAddressInfo = null,
                        public ?string $address1 = null,
                        public ?string $address2 = null,
                        public ?string $city = null,
                        public ?int $countryID = null,
                        public ?int $firstDayOfWeek = null,
                #[CastCarbon]
                public ?Carbon $fridayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $fridayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $fridayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $fridayExtendedHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $holidayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $holidayExtendedHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $holidayHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $holidayHoursStartTime = null,
                        public ?int $holidayHoursType = null,
                        public ?int $holidaySetID = null,
                        public ?bool $isDefault = null,
                #[CastCarbon]
                public ?Carbon $mondayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $mondayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $mondayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $mondayExtendedHoursStartTime = null,
                        public ?bool $noHoursOnHolidays = null,
                        public ?string $postalCode = null,
                #[CastCarbon]
                public ?Carbon $saturdayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $saturdayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $saturdayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $saturdayExtendedHoursStartTime = null,
                        public ?string $state = null,
                #[CastCarbon]
                public ?Carbon $sundayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $sundayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $sundayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $sundayExtendedHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $thursdayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $thursdayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $thursdayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $thursdayExtendedHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $tuesdayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $tuesdayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $tuesdayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $tuesdayExtendedHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $wednesdayBusinessHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $wednesdayBusinessHoursStartTime = null,
                #[CastCarbon]
                public ?Carbon $wednesdayExtendedHoursEndTime = null,
                #[CastCarbon]
                public ?Carbon $wednesdayExtendedHoursStartTime = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($dateFormat)) {
            foreach($dateFormat as $prop => $value) {
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
