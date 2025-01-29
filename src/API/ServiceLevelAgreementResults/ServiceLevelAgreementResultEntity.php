<?php

namespace Anteris\Autotask\API\ServiceLevelAgreementResults;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ServiceLevelAgreementResult entities.
 */
class ServiceLevelAgreementResultEntity extends Entity
{

    /**
     * Creates a new ServiceLevelAgreementResult entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?float $id, 
public ?float $firstResponseElapsedHours, 
public ?int $firstResponseInitiatingResourceID, 
public ?int $firstResponseResourceID, 
public ?bool $isFirstResponseMet, 
public ?bool $isResolutionMet, 
public ?bool $isResolutionPlanMet, 
public ?float $resolutionElapsedHours, 
public ?float $resolutionPlanElapsedHours, 
public ?int $resolutionPlanResourceID, 
public ?int $resolutionResourceID, 
public ?string $serviceLevelAgreementName, 
public ?int $ticketID, 
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
