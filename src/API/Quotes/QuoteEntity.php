<?php

namespace Anteris\Autotask\API\Quotes;

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
 * Represents Quote entities.
 */
class QuoteEntity extends Entity
{

    /**
     * Creates a new Quote entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                public ?int $billToLocationID = null,
        #[CastCarbon]
        public ?Carbon $effectiveDate = null,
        #[CastCarbon]
        public ?Carbon $expirationDate = null,
        public ?float $id = null,
        public ?string $name = null,
        public ?int $opportunityID = null,
        public ?int $shipToLocationID = null,
        public ?int $soldToLocationID = null,
        public ?int $approvalStatus = null,
        public ?int $approvalStatusChangedByResourceID = null,
        #[CastCarbon]
        public ?Carbon $approvalStatusChangedDate = null,
        public ?bool $calculateTaxSeparately = null,
        public ?string $comment = null,
        public ?int $companyID = null,
        public ?int $contactID = null,
        #[CastCarbon]
        public ?Carbon $createDate = null,
        public ?int $creatorResourceID = null,
        public ?string $description = null,
        public ?int $extApprovalContactResponse = null,
        #[CastCarbon]
        public ?Carbon $extApprovalResponseDate = null,
        public ?string $extApprovalResponseSignature = null,
        public ?string $externalQuoteNumber = null,
        public ?int $groupByID = null,
        public ?int $impersonatorCreatorResourceID = null,
        public ?bool $isActive = null,
        #[CastCarbon]
        public ?Carbon $lastActivityDate = null,
        public ?int $lastModifiedBy = null,
        public ?int $lastPublishedByResourceID = null,
        #[CastCarbon]
        public ?Carbon $lastPublishedDateTime = null,
        public ?int $paymentTerm = null,
        public ?int $paymentType = null,
        public ?bool $primaryQuote = null,
        public ?int $proposalProjectID = null,
        public ?string $purchaseOrderNumber = null,
        public ?int $quoteNumber = null,
        public ?int $quoteTemplateID = null,
        public ?int $shippingType = null,
        public ?bool $showEachTaxInGroup = null,
        public ?bool $showTaxCategory = null,
        public ?int $taxRegionID = null,
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
