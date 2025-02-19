<?php

namespace Anteris\Autotask\API\TimeOffRequests;

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
 * Represents TimeOffRequest entities.
 */
class TimeOffRequestEntity extends Entity
{

                /**
     * Creates a new TimeOffRequest entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public float|array|null $hours = null,
                        public ?float $id = null,
                #[CastCarbon]
                public ?Carbon $requestDate = null,
                        public ?int $resourceID = null,
                        public ?int $status = null,
                        public ?int $timeOffRequestType = null,
                #[CastCarbon]
                public ?Carbon $approvedDateTime = null,
                        public ?int $approveRejectResourceID = null,
                #[CastCarbon]
                public ?Carbon $createDateTime = null,
                        public ?int $createdByResourceID = null,
                #[CastCarbon]
                public ?Carbon $endTime = null,
                        public ?int $impersonatorApproveRejectResourceID = null,
                        public ?int $lastApprovedLevel = null,
                        public ?int $lastModifiedByResourceID = null,
                #[CastCarbon]
                public ?Carbon $lastModifiedDateTime = null,
                        public ?string $reason = null,
                        public ?string $rejectReason = null,
                #[CastCarbon]
                public ?Carbon $startTime = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($hours)) {
            foreach($hours as $prop => $value) {
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
