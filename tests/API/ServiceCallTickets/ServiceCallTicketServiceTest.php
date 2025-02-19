<?php

use Anteris\Autotask\API\ServiceCallTickets\ServiceCallTicketCollection;
use Anteris\Autotask\API\ServiceCallTickets\ServiceCallTicketService;
use Anteris\Autotask\API\ServiceCallTickets\ServiceCallTicketEntity;

use Anteris\Autotask\API\ServiceCallTickets\ServiceCallTicketQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ServiceCallTicketService.
 */
class ServiceCallTicketServiceTest extends AbstractTest
{
    /**
     * @covers ServiceCallTicketService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ServiceCallTicketService::class,
            $this->client->serviceCallTickets()
        );
    }

    /**
     * @covers ServiceCallTicketService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->serviceCallTickets()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ServiceCallTicketCollection::class,
            $result
        );
    }

    /**
     * @covers ServiceCallTicketCollection
     */
    public function test_collection_contains_service_call_ticket_entities()
    {
        $result = $this->client->serviceCallTickets()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ServiceCallTicketEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ServiceCallTicketService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ServiceCallTicketQueryBuilder::class,
            $this->client->serviceCallTickets()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ServiceCallTicketEntity::class);

        $entity = new ServiceCallTicketEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
