<?php

namespace Anteris\Autotask\API\ContactWebhooks;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ContactWebhook entities.
 */
class ContactWebhookEntity extends Entity
{

    /**
     * Creates a new ContactWebhook entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public string $deactivationUrl, 
                public int $id, 
                public bool $isActive, 
                public bool $isReady = false, 
                public bool $isSubscribedToCreateEvents = false, 
                public bool $isSubscribedToDeleteEvents = false, 
                public bool $isSubscribedToUpdateEvents = false, 
                public string $name, 
                public string $notificationEmailAddress = '', 
                public int $ownerResourceID = '', 
                public string $secretKey, 
                public bool $sendThresholdExceededNotification, 
                public string $webhookGuid = '', 
                public string $webhookUrl, 
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
