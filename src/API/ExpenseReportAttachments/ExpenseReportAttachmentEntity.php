<?php

namespace Anteris\Autotask\API\ExpenseReportAttachments;

use Anteris\Autotask\API\Entity;
use Anteris\Autotask\Generator\Helpers\CastCarbon;
use Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity;
use Carbon\Carbon;
use EventSauce\ObjectHydrator\DefinitionProvider;
use EventSauce\ObjectHydrator\KeyFormatterWithoutConversion;
use EventSauce\ObjectHydrator\ObjectMapperUsingReflection;
use EventSauce\ObjectHydrator\PropertyCasters\CastListToType;
use GuzzleHttp\Psr7\Response;

/**
 * Represents ExpenseReportAttachment entities.
 */
class ExpenseReportAttachmentEntity extends Entity
{

    /**
     * Creates a new ExpenseReportAttachment entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?string $attachmentType, 
public ?string $fullPath, 
public ?float $id, 
public ?int $publish, 
public ?string $title, 
#[CastCarbon]
        public ?Carbon $attachDate, 
public ?float $attachedByContactID, 
public ?float $attachedByResourceID, 
public ?string $contentType, 
public ?int $creatorType, 
public mixed $data, 
public ?int $expenseItemID, 
public ?int $expenseReportID, 
public ?float $fileSize, 
public ?int $impersonatorCreatorResourceID, 
public ?float $opportunityID, 
public ?float $parentID, 
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
