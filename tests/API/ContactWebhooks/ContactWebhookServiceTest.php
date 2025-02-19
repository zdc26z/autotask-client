<?php

use Anteris\Autotask\API\ContactWebhooks\ContactWebhookCollection;
use Anteris\Autotask\API\ContactWebhooks\ContactWebhookService;
use Anteris\Autotask\API\ContactWebhooks\ContactWebhookEntity;

use Anteris\Autotask\API\ContactWebhooks\ContactWebhookQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactWebhookService.
 */
class ContactWebhookServiceTest extends AbstractTest
{
    /**
     * @covers ContactWebhookService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactWebhookService::class,
            $this->client->contactWebhooks()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactWebhookEntity::class);

        $entity = new ContactWebhookEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
