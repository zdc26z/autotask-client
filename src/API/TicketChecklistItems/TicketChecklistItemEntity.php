<?php

namespace Anteris\Autotask\API\TicketChecklistItems;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents TicketChecklistItem entities.
 */
class TicketChecklistItemEntity extends Data
{
    public ?int $completedByResourceID;
    public ?Carbon $completedDateTime;
    public $id;
    public ?bool $isCompleted;
    public ?bool $isImportant;
    public string $itemName;
    public ?int $knowledgebaseArticleID;
    public ?int $position;
    public int $ticketID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new TicketChecklistItem entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
    {
        if (isset($array['completedDateTime'])) {
            $array['completedDateTime'] = new Carbon($array['completedDateTime']);
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
