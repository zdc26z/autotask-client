<?php

namespace Anteris\Autotask\API\Invoices;

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
 * Represents Invoice entities.
 */
class InvoiceEntity extends Entity
{

    /**
     * Creates a new Invoice entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?float $id, 
#[CastCarbon]
        public ?Carbon $invoiceDateTime, 
public ?int $batchID, 
public ?string $comments, 
public ?int $companyID, 
#[CastCarbon]
        public ?Carbon $createDateTime, 
public ?int $creatorResourceID, 
#[CastCarbon]
        public ?Carbon $dueDate, 
#[CastCarbon]
        public ?Carbon $fromDate, 
public ?int $invoiceEditorTemplateID, 
public ?string $invoiceNumber, 
public ?float $invoiceTotal, 
public ?bool $isVoided, 
public ?string $orderNumber, 
#[CastCarbon]
        public ?Carbon $paidDate, 
public ?int $paymentTerm, 
public ?int $taxGroup, 
public ?string $taxRegionName, 
#[CastCarbon]
        public ?Carbon $toDate, 
public ?float $totalTaxValue, 
public ?int $voidedByResourceID, 
#[CastCarbon]
        public ?Carbon $voidedDate, 
#[CastCarbon]
        public ?Carbon $webServiceDate, 
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
