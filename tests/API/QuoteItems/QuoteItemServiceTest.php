<?php

use Anteris\Autotask\API\QuoteItems\QuoteItemCollection;
use Anteris\Autotask\API\QuoteItems\QuoteItemService;
use Anteris\Autotask\API\QuoteItems\QuoteItemEntity;

use Anteris\Autotask\API\QuoteItems\QuoteItemQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for QuoteItemService.
 */
class QuoteItemServiceTest extends AbstractTest
{
    /**
     * @covers QuoteItemService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            QuoteItemService::class,
            $this->client->quoteItems()
        );
    }

    /**
     * @covers QuoteItemService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->quoteItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            QuoteItemCollection::class,
            $result
        );
    }

    /**
     * @covers QuoteItemCollection
     */
    public function test_collection_contains_quote_item_entities()
    {
        $result = $this->client->quoteItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                QuoteItemEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers QuoteItemService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            QuoteItemQueryBuilder::class,
            $this->client->quoteItems()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), QuoteItemEntity::class);

        $entity = new QuoteItemEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
