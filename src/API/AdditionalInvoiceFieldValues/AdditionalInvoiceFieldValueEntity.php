<?php

namespace Anteris\Autotask\API\AdditionalInvoiceFieldValues;

use GuzzleHttp\Psr7\Response;
use Spatie\LaravelData\Data;

/**
 * Represents AdditionalInvoiceFieldValue entities.
 */
class AdditionalInvoiceFieldValueEntity extends Data
{
    public $additionalInvoiceFieldID;
    public string $fieldValue;
    public $id;
    public $invoiceBatchID;
    /** @var \Anteris\Autotask\Support\UserDefinedFields\UserDefinedFieldEntity[]|null */
    public ?array $userDefinedFields;

    /**
     * Creates a new AdditionalInvoiceFieldValue entity.
     * If this entity has dates, they will be cast as Carbon objects.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(array $array)
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

        return new self($responseArray['item']);
    }
}
