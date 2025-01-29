<?php

namespace Anteris\Autotask\API\QuoteTemplates;

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
 * Represents QuoteTemplate entities.
 */
class QuoteTemplateEntity extends Entity
{

    /**
     * Creates a new QuoteTemplate entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(
        public ?string $currencyNegativeFormat, 
public ?string $currencyPositiveFormat, 
public ?float $id, 
public ?string $name, 
public ?bool $calculateTaxSeparately, 
#[CastCarbon]
        public ?Carbon $createDate, 
public ?int $createdBy, 
public ?int $dateFormat, 
public ?string $description, 
public ?bool $displayTaxCategorySuperscripts, 
public ?bool $isActive, 
public ?int $lastActivityBy, 
#[CastCarbon]
        public ?Carbon $lastActivityDate, 
public ?int $numberFormat, 
public ?int $pageLayout, 
public ?int $pageNumberFormat, 
public ?bool $showEachTaxInGroup, 
public ?bool $showGridHeader, 
public ?bool $showTaxCategory, 
public ?bool $showVerticalGridLines, 
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
