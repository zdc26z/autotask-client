<?php

use Anteris\Autotask\API\DocumentTagAssociations\DocumentTagAssociationCollection;
use Anteris\Autotask\API\DocumentTagAssociations\DocumentTagAssociationService;
use Anteris\Autotask\API\DocumentTagAssociations\DocumentTagAssociationEntity;

use Anteris\Autotask\API\DocumentTagAssociations\DocumentTagAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentTagAssociationService.
 */
class DocumentTagAssociationServiceTest extends AbstractTest
{
    /**
     * @covers DocumentTagAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentTagAssociationService::class,
            $this->client->documentTagAssociations()
        );
    }

    /**
     * @covers DocumentTagAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentTagAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentTagAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentTagAssociationCollection
     */
    public function test_collection_contains_document_tag_association_entities()
    {
        $result = $this->client->documentTagAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentTagAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentTagAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentTagAssociationQueryBuilder::class,
            $this->client->documentTagAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentTagAssociationEntity::class);

        $entity = new DocumentTagAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
