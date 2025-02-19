<?php

namespace Anteris\Autotask\API\SalesOrders;

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
                        public int|array|null $companyID = null,
                        public ?int $contactID = null,
                        public ?int $id = null,
                        public ?int $opportunityID = null,
                        public ?int $ownerResourceID = null,
                #[CastCarbon]
                public ?Carbon $salesOrderDate = null,
                        public ?int $status = null,
                        public ?string $title = null,
                        public ?string $additionalBillToAddressInformation = null,
                        public ?string $additionalShipToAddressInformation = null,
                        public ?string $billingAddress1 = null,
                        public ?string $billingAddress2 = null,
                        public ?string $billToCity = null,
                        public ?int $billToCountryID = null,
                        public ?string $billToPostalCode = null,
                        public ?string $billToState = null,
                        public ?int $impersonatorCreatorResourceID = null,
                        public ?int $organizationalLevelAssociationID = null,
                #[CastCarbon]
                public ?Carbon $promisedFulfillmentDate = null,
                        public ?string $shipToAddress1 = null,
                        public ?string $shipToAddress2 = null,
                        public ?string $shipToCity = null,
                        public ?int $shipToCountryID = null,
                        public ?string $shipToPostalCode = null,
                        public ?string $shipToState = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($companyID)) {
            foreach($companyID as $prop => $value) {
                if(property_exists($this, $prop)) {
                    $this->$prop = $value;
                }
            }
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

        $mapper = new ObjectMapperUsingReflection(
            new DefinitionProvider(
                keyFormatter: new KeyFormatterWithoutConversion(),
            ),
        );
        return $mapper->hydrateObject(self::class, $responseArray['item']);
    }
}
