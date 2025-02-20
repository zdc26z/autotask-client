<?php

use Anteris\Autotask\API\TicketCategories\TicketCategoryCollection;
use Anteris\Autotask\API\TicketCategories\TicketCategoryService;
use Anteris\Autotask\API\TicketCategories\TicketCategoryEntity;

use Anteris\Autotask\API\TicketCategories\TicketCategoryQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketCategoryService.
 */
class TicketCategoryServiceTest extends AbstractTest
{
    /**
     * @covers TicketCategoryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketCategoryService::class,
            $this->client->ticketCategories()
        );
    }

    /**
     * @covers TicketCategoryService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->ticketCategories()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TicketCategoryCollection::class,
            $result
        );
    }

    /**
     * @covers TicketCategoryCollection
     */
    public function test_collection_contains_ticket_category_entities()
    {
        $result = $this->client->ticketCategories()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TicketCategoryEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TicketCategoryService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TicketCategoryQueryBuilder::class,
            $this->client->ticketCategories()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketCategoryEntity::class);

        $entity = new TicketCategoryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
