<?php

namespace Anteris\Autotask\API\TicketWebhooks;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents TicketWebhook entities.
 */
class TicketWebhookEntity extends Entity
{

    /**
     * Creates a new TicketWebhook entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?string $deactivationUrl, 
public ?float $id, 
public ?bool $isActive, 
public ?string $name, 
public ?string $secretKey, 
public ?bool $sendThresholdExceededNotification, 
public ?string $webhookUrl, 
public ?bool $isReady, 
public ?bool $isSubscribedToCreateEvents, 
public ?bool $isSubscribedToDeleteEvents, 
public ?bool $isSubscribedToUpdateEvents, 
public ?string $notificationEmailAddress, 
public ?int $ownerResourceID, 
public ?string $webhookGuid, 
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
