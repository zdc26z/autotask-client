<?php

use Anteris\Autotask\API\ContactWebhookUdfFields\ContactWebhookUdfFieldCollection;
use Anteris\Autotask\API\ContactWebhookUdfFields\ContactWebhookUdfFieldService;
use Anteris\Autotask\API\ContactWebhookUdfFields\ContactWebhookUdfFieldEntity;

use Anteris\Autotask\API\ContactWebhookUdfFields\ContactWebhookUdfFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContactWebhookUdfFieldService.
 */
class ContactWebhookUdfFieldServiceTest extends AbstractTest
{
    /**
     * @covers ContactWebhookUdfFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContactWebhookUdfFieldService::class,
            $this->client->contactWebhookUdfFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContactWebhookUdfFieldEntity::class);

        $entity = new ContactWebhookUdfFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
