<?php

use Anteris\Autotask\API\Quotes\QuoteCollection;
use Anteris\Autotask\API\Quotes\QuoteService;
use Anteris\Autotask\API\Quotes\QuoteEntity;

use Anteris\Autotask\API\Quotes\QuoteQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for QuoteService.
 */
class QuoteServiceTest extends AbstractTest
{
    /**
     * @covers QuoteService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            QuoteService::class,
            $this->client->quotes()
        );
    }

    /**
     * @covers QuoteService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->quotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            QuoteCollection::class,
            $result
        );
    }

    /**
     * @covers QuoteCollection
     */
    public function test_collection_contains_quote_entities()
    {
        $result = $this->client->quotes()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                QuoteEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers QuoteService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            QuoteQueryBuilder::class,
            $this->client->quotes()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), QuoteEntity::class);

        $entity = new QuoteEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
