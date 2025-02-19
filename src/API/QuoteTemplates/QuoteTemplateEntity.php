<?php

namespace Anteris\Autotask\API\QuoteTemplates;

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
                        public string|array|null $currencyNegativeFormat = null,
                        public ?string $currencyPositiveFormat = null,
                        public ?float $id = null,
                        public ?string $name = null,
                        public ?bool $calculateTaxSeparately = null,
                #[CastCarbon]
                public ?Carbon $createDate = null,
                        public ?int $createdBy = null,
                        public ?int $dateFormat = null,
                        public ?string $description = null,
                        public ?bool $displayTaxCategorySuperscripts = null,
                        public ?bool $isActive = null,
                        public ?int $lastActivityBy = null,
                #[CastCarbon]
                public ?Carbon $lastActivityDate = null,
                        public ?int $numberFormat = null,
                        public ?int $pageLayout = null,
                        public ?int $pageNumberFormat = null,
                        public ?bool $showEachTaxInGroup = null,
                        public ?bool $showGridHeader = null,
                        public ?bool $showTaxCategory = null,
                        public ?bool $showVerticalGridLines = null,
                #[CastListToType(UserDefinedFieldEntity::class)]
        public array $userDefinedFields = [],
    )
    {
        if(is_array($currencyNegativeFormat)) {
            foreach($currencyNegativeFormat as $prop => $value) {
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
