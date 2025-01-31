<?php

namespace Anteris\Autotask\API\ServiceCalls;

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
 * Represents ServiceCall entities.
 */
class ServiceCallEntity extends Entity
{

    /**
     * Creates a new ServiceCall entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $companyID, 
#[CastCarbon]
        public ?Carbon $endDateTime, 
public ?float $id, 
#[CastCarbon]
        public ?Carbon $startDateTime, 
public ?float $cancelationNoticeHours, 
public ?int $canceledByResourceID, 
#[CastCarbon]
        public ?Carbon $canceledDateTime, 
public ?int $companyLocationID, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $creatorResourceID, 
public ?string $description, 
public ?float $duration, 
public ?int $impersonatorCreatorResourceID, 
public mixed $isComplete, 
#[CastCarbon]
        public ?Carbon $lastModifiedDateTime, 
public ?int $status, 
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
