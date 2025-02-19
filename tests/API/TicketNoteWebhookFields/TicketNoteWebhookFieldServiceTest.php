<?php

use Anteris\Autotask\API\TicketNoteWebhookFields\TicketNoteWebhookFieldCollection;
use Anteris\Autotask\API\TicketNoteWebhookFields\TicketNoteWebhookFieldService;
use Anteris\Autotask\API\TicketNoteWebhookFields\TicketNoteWebhookFieldEntity;

use Anteris\Autotask\API\TicketNoteWebhookFields\TicketNoteWebhookFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketNoteWebhookFieldService.
 */
class TicketNoteWebhookFieldServiceTest extends AbstractTest
{
    /**
     * @covers TicketNoteWebhookFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketNoteWebhookFieldService::class,
            $this->client->ticketNoteWebhookFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketNoteWebhookFieldEntity::class);

        $entity = new TicketNoteWebhookFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
