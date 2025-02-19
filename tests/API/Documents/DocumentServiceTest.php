<?php

use Anteris\Autotask\API\Documents\DocumentCollection;
use Anteris\Autotask\API\Documents\DocumentService;
use Anteris\Autotask\API\Documents\DocumentEntity;

use Anteris\Autotask\API\Documents\DocumentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentService.
 */
class DocumentServiceTest extends AbstractTest
{
    /**
     * @covers DocumentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentService::class,
            $this->client->documents()
        );
    }

    /**
     * @covers DocumentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documents()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentCollection
     */
    public function test_collection_contains_document_entities()
    {
        $result = $this->client->documents()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentQueryBuilder::class,
            $this->client->documents()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentEntity::class);

        $entity = new DocumentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
