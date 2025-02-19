<?php

use Anteris\Autotask\API\ConfigurationItemAttachments\ConfigurationItemAttachmentCollection;
use Anteris\Autotask\API\ConfigurationItemAttachments\ConfigurationItemAttachmentService;
use Anteris\Autotask\API\ConfigurationItemAttachments\ConfigurationItemAttachmentEntity;

use Anteris\Autotask\API\ConfigurationItemAttachments\ConfigurationItemAttachmentQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ConfigurationItemAttachmentService.
 */
class ConfigurationItemAttachmentServiceTest extends AbstractTest
{
    /**
     * @covers ConfigurationItemAttachmentService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ConfigurationItemAttachmentService::class,
            $this->client->configurationItemAttachments()
        );
    }

    /**
     * @covers ConfigurationItemAttachmentService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->configurationItemAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ConfigurationItemAttachmentCollection::class,
            $result
        );
    }

    /**
     * @covers ConfigurationItemAttachmentCollection
     */
    public function test_collection_contains_configuration_item_attachment_entities()
    {
        $result = $this->client->configurationItemAttachments()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ConfigurationItemAttachmentEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ConfigurationItemAttachmentService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ConfigurationItemAttachmentQueryBuilder::class,
            $this->client->configurationItemAttachments()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ConfigurationItemAttachmentEntity::class);

        $entity = new ConfigurationItemAttachmentEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
