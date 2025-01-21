<?php

namespace Anteris\Autotask\API\DeletedTicketActivityLogs;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents DeletedTicketActivityLog entities.
 */
class DeletedTicketActivityLogEntity extends Data
{
    public Carbon $activityDateTime;
    public int $createdByResourceID;
    public int $deletedByResourceID;
    public Carbon $deletedDateTime;
    public ?Carbon $endDateTime;
    public ?float $hoursWorked;
    public $id;
    public string $noteOrAttachmentTitle;
    public ?Carbon $startDateTime;
    public int $ticketID;
    public string $ticketNumber;
    public int $typeID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new DeletedTicketActivityLog entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
    {
        if (isset($array['activityDateTime'])) {
            $array['activityDateTime'] = new Carbon($array['activityDateTime']);
        }

        if (isset($array['deletedDateTime'])) {
            $array['deletedDateTime'] = new Carbon($array['deletedDateTime']);
        }

        if (isset($array['endDateTime'])) {
            $array['endDateTime'] = new Carbon($array['endDateTime']);
        }

        if (isset($array['startDateTime'])) {
            $array['startDateTime'] = new Carbon($array['startDateTime']);
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
