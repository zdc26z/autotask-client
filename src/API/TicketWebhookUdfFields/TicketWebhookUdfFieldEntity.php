<?php

namespace Anteris\Autotask\API\TicketWebhookUdfFields;

use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents TicketWebhookUdfField entities.
 */
class TicketWebhookUdfFieldEntity extends Data
{
    public $id;
    public bool $isDisplayAlwaysField;
    public bool $isSubscribedField;
    public int $udfFieldID;
    public int $webhookID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new TicketWebhookUdfField entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
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

        return new self($responseArray['item']);
    }
}
