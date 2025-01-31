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
        public ?float $hours, 
public ?float $id, 
#[CastCarbon]
        public ?Carbon $requestDate, 
public ?int $resourceID, 
public ?int $status, 
public ?int $timeOffRequestType, 
#[CastCarbon]
        public ?Carbon $approvedDateTime, 
public ?int $approveRejectResourceID, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $createdByResourceID, 
#[CastCarbon]
        public ?Carbon $endTime, 
public ?int $impersonatorApproveRejectResourceID, 
public ?int $lastApprovedLevel, 
public ?int $lastModifiedByResourceID, 
#[CastCarbon]
        public ?Carbon $lastModifiedDateTime, 
public ?string $reason, 
public ?string $rejectReason, 
#[CastCarbon]
        public ?Carbon $startTime, 
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
