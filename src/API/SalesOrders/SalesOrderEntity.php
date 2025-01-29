<?php

namespace Anteris\Autotask\API\SalesOrders;

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
 * Represents SalesOrder entities.
 */
class SalesOrderEntity extends Entity
{

    /**
     * Creates a new SalesOrder entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?int $companyID, 
public ?int $contactID, 
public ?int $id, 
public ?int $opportunityID, 
public ?int $ownerResourceID, 
#[CastCarbon]
        public ?Carbon $salesOrderDate, 
public ?int $status, 
public ?string $title, 
public ?string $additionalBillToAddressInformation, 
public ?string $additionalShipToAddressInformation, 
public ?string $billingAddress1, 
public ?string $billingAddress2, 
public ?string $billToCity, 
public ?int $billToCountryID, 
public ?string $billToPostalCode, 
public ?string $billToState, 
public ?int $impersonatorCreatorResourceID, 
public ?int $organizationalLevelAssociationID, 
#[CastCarbon]
        public ?Carbon $promisedFulfillmentDate, 
public ?string $shipToAddress1, 
public ?string $shipToAddress2, 
public ?string $shipToCity, 
public ?int $shipToCountryID, 
public ?string $shipToPostalCode, 
public ?string $shipToState, 
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
