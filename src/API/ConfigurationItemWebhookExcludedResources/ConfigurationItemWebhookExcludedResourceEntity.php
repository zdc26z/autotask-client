<?php

namespace Anteris\Autotask\API\ConfigurationItemWebhookExcludedResources;

use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents ConfigurationItemWebhookExcludedResource entities.
 */
class ConfigurationItemWebhookExcludedResourceEntity extends Data
{
    public $id;
    public int $resourceID;
    public int $webhookID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new ConfigurationItemWebhookExcludedResource entity.
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
