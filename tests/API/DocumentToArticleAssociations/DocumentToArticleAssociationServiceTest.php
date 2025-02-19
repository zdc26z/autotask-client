<?php

use Anteris\Autotask\API\DocumentToArticleAssociations\DocumentToArticleAssociationCollection;
use Anteris\Autotask\API\DocumentToArticleAssociations\DocumentToArticleAssociationService;
use Anteris\Autotask\API\DocumentToArticleAssociations\DocumentToArticleAssociationEntity;

use Anteris\Autotask\API\DocumentToArticleAssociations\DocumentToArticleAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DocumentToArticleAssociationService.
 */
class DocumentToArticleAssociationServiceTest extends AbstractTest
{
    /**
     * @covers DocumentToArticleAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DocumentToArticleAssociationService::class,
            $this->client->documentToArticleAssociations()
        );
    }

    /**
     * @covers DocumentToArticleAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->documentToArticleAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DocumentToArticleAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers DocumentToArticleAssociationCollection
     */
    public function test_collection_contains_document_to_article_association_entities()
    {
        $result = $this->client->documentToArticleAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DocumentToArticleAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DocumentToArticleAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DocumentToArticleAssociationQueryBuilder::class,
            $this->client->documentToArticleAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DocumentToArticleAssociationEntity::class);

        $entity = new DocumentToArticleAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
