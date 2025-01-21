<?php

namespace Anteris\Autotask\API\ArticleNotes;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents ArticleNote entities.
 */
class ArticleNoteEntity extends Data
{
    public int $articleID;
    public ?int $createdByResourceID;
    public ?Carbon $createdDateTime;
    public string $description;
    public $id;
    public ?int $lastModifiedByResourceID;
    public ?Carbon $lastModifiedDateTime;
    public string $title;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new ArticleNote entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
    {
        if (isset($array['createdDateTime'])) {
            $array['createdDateTime'] = new Carbon($array['createdDateTime']);
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
