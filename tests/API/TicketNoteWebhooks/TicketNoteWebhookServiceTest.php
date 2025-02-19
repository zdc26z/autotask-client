<?php

use Anteris\Autotask\API\TicketNoteWebhooks\TicketNoteWebhookCollection;
use Anteris\Autotask\API\TicketNoteWebhooks\TicketNoteWebhookService;
use Anteris\Autotask\API\TicketNoteWebhooks\TicketNoteWebhookEntity;

use Anteris\Autotask\API\TicketNoteWebhooks\TicketNoteWebhookQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketNoteWebhookService.
 */
class TicketNoteWebhookServiceTest extends AbstractTest
{
    /**
     * @covers TicketNoteWebhookService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketNoteWebhookService::class,
            $this->client->ticketNoteWebhooks()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketNoteWebhookEntity::class);

        $entity = new TicketNoteWebhookEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
