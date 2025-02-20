<?php

use Anteris\Autotask\API\ArticleTicketAssociations\ArticleTicketAssociationCollection;
use Anteris\Autotask\API\ArticleTicketAssociations\ArticleTicketAssociationService;
use Anteris\Autotask\API\ArticleTicketAssociations\ArticleTicketAssociationEntity;

use Anteris\Autotask\API\ArticleTicketAssociations\ArticleTicketAssociationQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ArticleTicketAssociationService.
 */
class ArticleTicketAssociationServiceTest extends AbstractTest
{
    /**
     * @covers ArticleTicketAssociationService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ArticleTicketAssociationService::class,
            $this->client->articleTicketAssociations()
        );
    }

    /**
     * @covers ArticleTicketAssociationService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->articleTicketAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ArticleTicketAssociationCollection::class,
            $result
        );
    }

    /**
     * @covers ArticleTicketAssociationCollection
     */
    public function test_collection_contains_article_ticket_association_entities()
    {
        $result = $this->client->articleTicketAssociations()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ArticleTicketAssociationEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ArticleTicketAssociationService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ArticleTicketAssociationQueryBuilder::class,
            $this->client->articleTicketAssociations()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ArticleTicketAssociationEntity::class);

        $entity = new ArticleTicketAssociationEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
