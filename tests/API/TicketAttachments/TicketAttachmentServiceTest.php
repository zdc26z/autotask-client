<?php

use Anteris\Autotask\API\TicketAttachments\TicketAttachmentCollection;
use Anteris\Autotask\API\TicketAttachments\TicketAttachmentService;
use Anteris\Autotask\API\TicketAttachments\TicketAttachmentEntity;

use Anteris\Autotask\API\TicketAttachments\TicketAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketAttachmentService.
 */
class TicketAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers TicketAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketAttachmentService::class,
            $this->client->ticketAttachments()
        );
    }

    /**
     * @covers TicketAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->ticketAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            TicketAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers TicketAttachmentCollection
     */
    public function test_collection_contains_ticket_attachment_entities()
    {
        $result = $this->client->ticketAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                TicketAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers TicketAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            TicketAttachmentQueryBuilder::class,
            $this->client->ticketAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketAttachmentEntity::class);

        $entity = new TicketAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
