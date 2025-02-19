<?php

use Anteris\Autotask\API\ConfigurationItemWebhookFields\ConfigurationItemWebhookFieldCollection;
use Anteris\Autotask\API\ConfigurationItemWebhookFields\ConfigurationItemWebhookFieldService;
use Anteris\Autotask\API\ConfigurationItemWebhookFields\ConfigurationItemWebhookFieldEntity;

use Anteris\Autotask\API\ConfigurationItemWebhookFields\ConfigurationItemWebhookFieldQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemWebhookFieldService.
 */
class ConfigurationItemWebhookFieldServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemWebhookFieldService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemWebhookFieldService::class,
            $this->client->configurationItemWebhookFields()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemWebhookFieldEntity::class);

        $entity = new ConfigurationItemWebhookFieldEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
