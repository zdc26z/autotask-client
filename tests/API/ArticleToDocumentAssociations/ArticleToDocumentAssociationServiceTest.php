<?php

use Anteris\Autotask\API\ArticleToDocumentAssociations\ArticleToDocumentAssociationCollection;
use Anteris\Autotask\API\ArticleToDocumentAssociations\ArticleToDocumentAssociationService;
use Anteris\Autotask\API\ArticleToDocumentAssociations\ArticleToDocumentAssociationEntity;

use Anteris\Autotask\API\ArticleToDocumentAssociations\ArticleToDocumentAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ArticleToDocumentAssociationService.
 */
class ArticleToDocumentAssociationServiceTest extends AbstractTest
{
    /**
     * @covers ArticleToDocumentAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ArticleToDocumentAssociationService::class,
            $this->client->articleToDocumentAssociations()
        );
    }

    /**
     * @covers ArticleToDocumentAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->articleToDocumentAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ArticleToDocumentAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers ArticleToDocumentAssociationCollection
     */
    public function test_collection_contains_article_to_document_association_entities()
    {
        $result = $this->client->articleToDocumentAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ArticleToDocumentAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ArticleToDocumentAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ArticleToDocumentAssociationQueryBuilder::class,
            $this->client->articleToDocumentAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ArticleToDocumentAssociationEntity::class);

        $entity = new ArticleToDocumentAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
