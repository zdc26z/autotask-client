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
                        public int|array|null $companyID = null,
                #[CastCarbon]
                public ?Carbon $endDateTime = null,
                        public ?float $id = null,
                #[CastCarbon]
                public ?Carbon $startDateTime = null,
                        public ?float $cancelationNoticeHours = null,
                        public ?int $canceledByResourceID = null,
                #[CastCarbon]
                public ?Carbon $canceledDateTime = null,
                        public ?int $companyLocationID = null,
                #[CastCarbon]
                public ?Carbon $createDateTime = null,
                        public ?int $creatorResourceID = null,
                        public ?string $description = null,
                        public ?float $duration = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public mixed $isComplete = null,
                #[CastCarbon]
                public ?Carbon $lastModifiedDateTime = null,
                        public ?int $status = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($companyID)) {
            foreach($companyID as $prop => $value) {
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
