<?php

namespace Anteris\Autotask\API\Services;

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
 * Represents Service entities.
 */
class ServiceEntity extends Entity
{

    /**
     * Creates a new Service entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
                    public int $billingCodeID, 
                public string $catalogNumberPartNumber = '', 
        #[CastCarbon]
                public Carbon $createDate = new Carbon(), 
                public int $creatorResourceID = '', 
                public string $description = '', 
                public string $externalID = '', 
                public int $id, 
                public string $internalID = '', 
                public string $invoiceDescription = '', 
                public bool $isActive = false, 
        #[CastCarbon]
                public Carbon $lastModifiedDate = new Carbon(), 
                public string $manufacturerServiceProvider = '', 
                public string $manufacturerServiceProviderProductNumber = '', 
                public float $markupRate = '', 
                public string $name, 
                public int $periodType, 
                public int $serviceLevelAgreementID = '', 
                public string $sku = '', 
                public float $unitCost = '', 
                public float $unitPrice, 
                public int $updateResourceID = '', 
                public string $url = '', 
                public int $vendorCompanyID = '', 
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
