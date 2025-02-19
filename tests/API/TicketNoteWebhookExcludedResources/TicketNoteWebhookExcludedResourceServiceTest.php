<?php

use Anteris\Autotask\API\TicketNoteWebhookExcludedResources\TicketNoteWebhookExcludedResourceCollection;
use Anteris\Autotask\API\TicketNoteWebhookExcludedResources\TicketNoteWebhookExcludedResourceService;
use Anteris\Autotask\API\TicketNoteWebhookExcludedResources\TicketNoteWebhookExcludedResourceEntity;

use Anteris\Autotask\API\TicketNoteWebhookExcludedResources\TicketNoteWebhookExcludedResourceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for TicketNoteWebhookExcludedResourceService.
 */
class TicketNoteWebhookExcludedResourceServiceTest extends AbstractTest
{
    /**
     * @covers TicketNoteWebhookExcludedResourceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            TicketNoteWebhookExcludedResourceService::class,
            $this->client->ticketNoteWebhookExcludedResources()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), TicketNoteWebhookExcludedResourceEntity::class);

        $entity = new TicketNoteWebhookExcludedResourceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
