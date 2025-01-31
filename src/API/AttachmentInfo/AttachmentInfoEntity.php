<?php

namespace Anteris\Autotask\API\AttachmentInfo;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Support\CastCarbon;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use Carbon\Carbon;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents AttachmentInfo entities.
 */
class AttachmentInfoEntity extends Entity
{

    /**
     * Creates a new AttachmentInfo entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?string $attachmentType, 
public ?string $fullPath, 
public ?float $id, 
public ?int $parentType, 
public ?int $publish, 
public ?string $title, 
public ?int $articleID, 
#[CastCarbon]
        public ?Carbon $attachDate, 
public ?float $attachedByContactID, 
public ?float $attachedByResourceID, 
public ?int $companyID, 
public ?int $companyNoteID, 
public ?int $configurationItemID, 
public ?int $configurationItemNoteID, 
public ?string $contentType, 
public ?int $contractID, 
public ?int $contractNoteID, 
public ?int $creatorType, 
public ?int $documentID, 
public ?int $expenseItemID, 
public ?int $expenseReportID, 
public ?float $fileSize, 
public ?int $impersonatorCreatorResourceID, 
public ?float $opportunityID, 
public ?int $parentAttachmentID, 
public ?float $parentID, 
public ?int $projectID, 
public ?int $projectNoteID, 
public ?int $resourceID, 
public ?int $salesOrderID, 
public ?int $taskID, 
public ?int $taskNoteID, 
public ?int $ticketID, 
public ?int $ticketNoteID, 
public ?int $timeEntryID, 
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
