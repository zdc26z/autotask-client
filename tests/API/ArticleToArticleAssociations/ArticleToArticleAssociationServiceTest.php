<?php

use Anteris\Autotask\API\ArticleToArticleAssociations\ArticleToArticleAssociationCollection;
use Anteris\Autotask\API\ArticleToArticleAssociations\ArticleToArticleAssociationService;
use Anteris\Autotask\API\ArticleToArticleAssociations\ArticleToArticleAssociationEntity;

use Anteris\Autotask\API\ArticleToArticleAssociations\ArticleToArticleAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ArticleToArticleAssociationService.
 */
class ArticleToArticleAssociationServiceTest extends AbstractTest
{
    /**
     * @covers ArticleToArticleAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ArticleToArticleAssociationService::class,
            $this->client->articleToArticleAssociations()
        );
    }

    /**
     * @covers ArticleToArticleAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->articleToArticleAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ArticleToArticleAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers ArticleToArticleAssociationCollection
     */
    public function test_collection_contains_article_to_article_association_entities()
    {
        $result = $this->client->articleToArticleAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ArticleToArticleAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ArticleToArticleAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ArticleToArticleAssociationQueryBuilder::class,
            $this->client->articleToArticleAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ArticleToArticleAssociationEntity::class);

        $entity = new ArticleToArticleAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
