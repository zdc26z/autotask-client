<?php

namespace Anteris\Autotask\API\TicketNoteWebhooks;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents TicketNoteWebhook entities.
 */
class TicketNoteWebhookEntity extends Entity
{

                /**
     * Creates a new TicketNoteWebhook entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                        public string|array|null $deactivationUrl = null,
                        public ?float $id = null,
                        public ?bool $isActive = null,
                        public ?string $name = null,
                        public ?string $secretKey = null,
                        public ?bool $sendThresholdExceededNotification = null,
                        public ?string $webhookUrl = null,
                        public ?bool $isReady = null,
                        public ?bool $isSubscribedToCreateEvents = null,
                        public ?bool $isSubscribedToDeleteEvents = null,
                        public ?bool $isSubscribedToUpdateEvents = null,
                        public ?string $notificationEmailAddress = null,
                        public ?int $ownerResourceID = null,
                        public ?string $webhookGuid = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($deactivationUrl)) {
            foreach($deactivationUrl as $prop => $value) {
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
