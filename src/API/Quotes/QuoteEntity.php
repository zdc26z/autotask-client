<?php

namespace Anteris\Autotask\API\Quotes;

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
        public ?int $billToLocationID, 
#[CastCarbon]
        public ?Carbon $effectiveDate, 
#[CastCarbon]
        public ?Carbon $expirationDate, 
public ?float $id, 
public ?string $name, 
public ?int $opportunityID, 
public ?int $shipToLocationID, 
public ?int $soldToLocationID, 
public ?int $approvalStatus, 
public ?int $approvalStatusChangedByResourceID, 
#[CastCarbon]
        public ?Carbon $approvalStatusChangedDate, 
public ?bool $calculateTaxSeparately, 
public ?string $comment, 
public ?int $companyID, 
public ?int $contactID, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?int $creatorResourceID, 
public ?string $description, 
public ?int $extApprovalContactResponse, 
#[CastCarbon]
        public ?Carbon $extApprovalResponseDate, 
public ?string $extApprovalResponseSignature, 
public ?string $externalQuoteNumber, 
public ?int $groupByID, 
public ?int $impersonatorCreatorResourceID, 
public ?bool $isActive, 
#[CastCarbon]
        public ?Carbon $lastActivityDate, 
public ?int $lastModifiedBy, 
public ?int $lastPublishedByResourceID, 
#[CastCarbon]
        public ?Carbon $lastPublishedDateTime, 
public ?int $paymentTerm, 
public ?int $paymentType, 
public ?bool $primaryQuote, 
public ?int $proposalProjectID, 
public ?string $purchaseOrderNumber, 
public ?int $quoteNumber, 
public ?int $quoteTemplateID, 
public ?int $shippingType, 
public ?bool $showEachTaxInGroup, 
public ?bool $showTaxCategory, 
public ?int $taxRegionID, 
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
