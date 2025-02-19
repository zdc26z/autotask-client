<?php

use Anteris\Autotask\API\TicketHistory\TicketHistoryCollection;
use Anteris\Autotask\API\TicketHistory\TicketHistoryService;
use Anteris\Autotask\API\TicketHistory\TicketHistoryEntity;

use Anteris\Autotask\API\TicketHistory\TicketHistoryQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketHistoryService.
 */
class TicketHistoryServiceTest extends AbstractTest
{
    /**
     * @covers TicketHistoryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketHistoryService::class,
            $this->client->ticketHistory()
        );
    }

    /**
     * @covers TicketHistoryService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->ticketHistory()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TicketHistoryCollection::class,
            $result
        );
    }

    /**
     * @covers TicketHistoryCollection
     */
    public function test_collection_contains_ticket_history_entities()
    {
        $result = $this->client->ticketHistory()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TicketHistoryEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TicketHistoryService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TicketHistoryQueryBuilder::class,
            $this->client->ticketHistory()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketHistoryEntity::class);

        $entity = new TicketHistoryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
