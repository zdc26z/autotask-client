<?php

use Anteris\Autotask\API\ContactWebhookFields\ContactWebhookFieldCollection;
use Anteris\Autotask\API\ContactWebhookFields\ContactWebhookFieldService;
use Anteris\Autotask\API\ContactWebhookFields\ContactWebhookFieldEntity;

use Anteris\Autotask\API\ContactWebhookFields\ContactWebhookFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactWebhookFieldService.
 */
class ContactWebhookFieldServiceTest extends AbstractTest
{
    /**
     * @covers ContactWebhookFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactWebhookFieldService::class,
            $this->client->contactWebhookFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactWebhookFieldEntity::class);

        $entity = new ContactWebhookFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
