<?php

use Anteris\Autotask\API\DocumentPlainTextContent\DocumentPlainTextContentCollection;
use Anteris\Autotask\API\DocumentPlainTextContent\DocumentPlainTextContentService;
use Anteris\Autotask\API\DocumentPlainTextContent\DocumentPlainTextContentEntity;

use Anteris\Autotask\API\DocumentPlainTextContent\DocumentPlainTextContentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentPlainTextContentService.
 */
class DocumentPlainTextContentServiceTest extends AbstractTest
{
    /**
     * @covers DocumentPlainTextContentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentPlainTextContentService::class,
            $this->client->documentPlainTextContent()
        );
    }

    /**
     * @covers DocumentPlainTextContentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentPlainTextContent()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentPlainTextContentCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentPlainTextContentCollection
     */
    public function test_collection_contains_document_plain_text_content_entities()
    {
        $result = $this->client->documentPlainTextContent()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentPlainTextContentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentPlainTextContentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentPlainTextContentQueryBuilder::class,
            $this->client->documentPlainTextContent()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentPlainTextContentEntity::class);

        $entity = new DocumentPlainTextContentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
