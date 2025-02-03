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
                public ?float $id = null,
        #[CastCarbon]
        public ?Carbon $invoiceDateTime = null,
        public ?int $batchID = null,
        public ?string $comments = null,
        public ?int $companyID = null,
        #[CastCarbon]
        public ?Carbon $createDateTime = null,
        public ?int $creatorResourceID = null,
        #[CastCarbon]
        public ?Carbon $dueDate = null,
        #[CastCarbon]
        public ?Carbon $fromDate = null,
        public ?int $invoiceEditorTemplateID = null,
        public ?string $invoiceNumber = null,
        public ?float $invoiceTotal = null,
        public ?bool $isVoided = null,
        public ?string $orderNumber = null,
        #[CastCarbon]
        public ?Carbon $paidDate = null,
        public ?int $paymentTerm = null,
        public ?int $taxGroup = null,
        public ?string $taxRegionName = null,
        #[CastCarbon]
        public ?Carbon $toDate = null,
        public ?float $totalTaxValue = null,
        public ?int $voidedByResourceID = null,
        #[CastCarbon]
        public ?Carbon $voidedDate = null,
        #[CastCarbon]
        public ?Carbon $webServiceDate = null,
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
