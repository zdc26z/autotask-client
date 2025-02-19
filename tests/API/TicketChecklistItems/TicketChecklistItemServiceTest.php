<?php

use Anteris\Autotask\API\TicketChecklistItems\TicketChecklistItemCollection;
use Anteris\Autotask\API\TicketChecklistItems\TicketChecklistItemService;
use Anteris\Autotask\API\TicketChecklistItems\TicketChecklistItemEntity;

use Anteris\Autotask\API\TicketChecklistItems\TicketChecklistItemQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketChecklistItemService.
 */
class TicketChecklistItemServiceTest extends AbstractTest
{
    /**
     * @covers TicketChecklistItemService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketChecklistItemService::class,
            $this->client->ticketChecklistItems()
        );
    }

    /**
     * @covers TicketChecklistItemService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->ticketChecklistItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TicketChecklistItemCollection::class,
            $result
        );
    }

    /**
     * @covers TicketChecklistItemCollection
     */
    public function test_collection_contains_ticket_checklist_item_entities()
    {
        $result = $this->client->ticketChecklistItems()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TicketChecklistItemEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TicketChecklistItemService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TicketChecklistItemQueryBuilder::class,
            $this->client->ticketChecklistItems()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketChecklistItemEntity::class);

        $entity = new TicketChecklistItemEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
