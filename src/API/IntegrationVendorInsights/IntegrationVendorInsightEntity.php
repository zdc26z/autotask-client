<?php

namespace Anteris\Autotask\API\IntegrationVendorInsights;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents IntegrationVendorInsight entities.
 */
class IntegrationVendorInsightEntity extends Data
{
    public ?Carbon $createDateTime;
    public ?string $description;
    public ?int $height;
    public $id;
    public int $insightCategory;
    public string $insightKey;
    public ?bool $isActive;
    public ?Carbon $lastModifiedDateTime;
    public string $referenceUrl;
    public string $secret;
    public string $title;
    public string $vendorSuppliedID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new IntegrationVendorInsight entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
    {
        if (isset($array['createDateTime'])) {
            $array['createDateTime'] = new Carbon($array['createDateTime']);
        }

        if (isset($array['lastModifiedDateTime'])) {
            $array['lastModifiedDateTime'] = new Carbon($array['lastModifiedDateTime']);
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

        return new self($responseArray['item']);
    }
}
