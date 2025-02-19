<?php

use Anteris\Autotask\API\DocumentToDocumentAssociations\DocumentToDocumentAssociationCollection;
use Anteris\Autotask\API\DocumentToDocumentAssociations\DocumentToDocumentAssociationService;
use Anteris\Autotask\API\DocumentToDocumentAssociations\DocumentToDocumentAssociationEntity;

use Anteris\Autotask\API\DocumentToDocumentAssociations\DocumentToDocumentAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentToDocumentAssociationService.
 */
class DocumentToDocumentAssociationServiceTest extends AbstractTest
{
    /**
     * @covers DocumentToDocumentAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentToDocumentAssociationService::class,
            $this->client->documentToDocumentAssociations()
        );
    }

    /**
     * @covers DocumentToDocumentAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentToDocumentAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentToDocumentAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentToDocumentAssociationCollection
     */
    public function test_collection_contains_document_to_document_association_entities()
    {
        $result = $this->client->documentToDocumentAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentToDocumentAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentToDocumentAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentToDocumentAssociationQueryBuilder::class,
            $this->client->documentToDocumentAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentToDocumentAssociationEntity::class);

        $entity = new DocumentToDocumentAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
